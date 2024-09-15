<?php

namespace App\Nova\Actions;

use App\Models\DerajatNaskah;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddDerajatNaskah extends Action
{
    use InteractsWithQueue, Queueable;

    protected $resourceId;

    public function __construct($resourceId)
    {
        $this->resourceId = $resourceId;
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $derajatNaskah = new DerajatNaskah;
        $derajatNaskah->kode = $fields->kode;
        $derajatNaskah->derajat = $fields->derajat;
        $derajatNaskah->tata_naskah_id = $this->resourceId;
        $derajatNaskah->save();
        return Action::message('Derajat Naskah berhasil ditambahkan');
        
    }

    public $name = 'Tambah';

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Kode')
                ->rules('required'),
            Text::make('Derajat Naskah', 'derajat')
                ->rules('required'),
        ];
    }
}
