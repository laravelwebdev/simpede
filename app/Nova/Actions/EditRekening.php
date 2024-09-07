<?php

namespace App\Nova\Actions;

use App\Models\Mitra;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class EditRekening extends Action
{
    use InteractsWithQueue, Queueable;
    public $confirmButtonText = 'Edit Rekening';
    public $name = 'Edit';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $mitra = Mitra::where('nik', $model->nik)->first();
        $mitra->rekening = $fields->rekening;
        $mitra->save();
        $model->rekening = $fields->rekening;
        $model->save();

        return Action::message('Edit Rekening Berhasil!');
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Rekening', 'rekening')
                ->rules('required')->help('Contoh Penulisan Rekening: BRI 123456788089'),
        ];
    }
}
