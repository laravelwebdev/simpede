<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class SetStatus extends Action
{
    use InteractsWithQueue, Queueable;

    protected $status;
    protected bool $withTanggal = false;
    protected $statusField;
    protected bool $withUser = false;
    protected $column;
    protected $userColumn;
    protected $parent_id;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function withTanggal($column)
    {
        $this->withTanggal = true;
        $this->column = $column;

        return $this;
    }

    public function withUser($userColumn, $parent_id)
    {
        $this->withUser = true;
        $this->userColumn = $userColumn;
        $this->parent_id = $parent_id;

        return $this;
    }

    public function setStatus($status, $statusField = 'status')
    {
        $this->status = $status;
        $this->statusField = $statusField;

        return $this;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();

        if ($this->withTanggal) {
            $model->{$this->column} = $fields->tanggal;
            $model->kepala_user_id = $fields->kepala;
        }
        if ($this->withUser) {
            $model->{$this->userColumn} = $fields->user;
        }
        if ($this->withUser || $this->withTanggal) {
            $model->save();
        }
        $model->update([$this->statusField => $this->status]);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $fields = [];
        if ($this->withUser) {
            $fields[] = Select::make('Employee of the Month', 'user')
                ->options(Helper::setOptionsPemenang($this->parent_id))
                ->searchable()
                ->rules('required');
        }
        if ($this->withTanggal) {
            $fields[] = Date::make('Tanggal')
                ->default(now())
                ->rules('required', 'before_or_equal:today');
            $fields[] = Select::make('Kepala')
                ->searchable()
                ->rules('required')
                ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $form) {
                    $field->options(Helper::setOptionPengelola('kepala', $form->tanggal));
                });
        }

        return $fields;
    }
}
