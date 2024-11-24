<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class SetStatus extends Action
{
    use InteractsWithQueue, Queueable;

    protected $status;
    protected bool $withTanggal = false;
    protected $statusField;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function withTanggal()
    {
        $this->withTanggal = true;

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
        $model->query()->update([$this->statusField => $this->status]);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        if ($this->withTanggal) {
            return [
                Date::make('Tanggal')
                    ->rules('required', 'before_or_equal:today'),
            ];
        }
        return [];
    }
}
