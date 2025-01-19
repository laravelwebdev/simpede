<?php

namespace App\Nova\Actions;

use App\Helpers\Cetak;
use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Download extends Action
{
    use InteractsWithQueue, Queueable;

    protected $jenis;

    protected $title;

    protected bool $withTanggal = false;

    protected bool $withOptionPengelola = false;

    protected string $role;

    public function __construct($jenis, $title = 'Unduh')
    {
        $this->jenis = $jenis;
        $this->title = $title;
    }

    public function withTanggal()
    {
        $this->withTanggal = true;

        return $this;
    }

    public function withOptionPengelola($role)
    {
        $this->withOptionPengelola = true;
        $this->withTanggal = true;
        $this->role = $role;

        return $this;
    }

    public function name()
    {
        return $this->title;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $validationMessage = Cetak::validate($this->jenis, $model->id);
            if (! is_null($validationMessage)) {
                return Action::danger($validationMessage);
            }
        }
        $filename = Cetak::cetak($this->jenis, $models, $fields->filename, $fields->template, $fields->tanggal, $fields->pengelola);

        return Action::redirect(route('dump-download', [
            'filename' => $filename,
        ]));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $fields = [
            Text::make('Nama File', 'filename')
                ->rules('required', 'regex:/^[a-zA-Z0-9_\-\s]+$/')
                ->help('tanpa extensi file')
                ->default(fn () => uniqid()),
            Select::make('Template')
                ->rules('required')
                ->options(Helper::setOptionTemplate($this->jenis))
                ->default(Helper::setDefaultTemplate($this->jenis)),
        ];

        if ($this->withTanggal) {
            $fields[] = Date::make('Tanggal', 'tanggal')
                ->rules('required', 'date', 'before_or_equal:today')
                ->default(now());
        }

        if ($this->withOptionPengelola) {
            $fields[] = Select::make('Pengelola')
                ->rules('required')
                ->searchable()
                ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $form) {
                    $field->options(Helper::setOptionPengelola($this->role, $form->tanggal))
                        ->default(Helper::setDefaultPengelola($this->role, $form->tanggal));
                });
        }

        return $fields;
    }
}
