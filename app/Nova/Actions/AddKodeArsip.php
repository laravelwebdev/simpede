<?php

namespace App\Nova\Actions;

use App\Models\KodeArsip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddKodeArsip extends Action
{
    use InteractsWithQueue, Queueable;

    protected $resourceId;

    public function __construct($resourceId)
    {
        $this->resourceId = $resourceId;
    }

    public $name = 'Tambah';


    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $kodeArsip = new KodeArsip;
        $kodeArsip->kode = $fields->kode;
        $kodeArsip->group = $fields->group;
        $kodeArsip->detail = $fields->detail;
        $kodeArsip->tata_naskah_id = $this->resourceId;
        $kodeArsip->save();
        return Action::message('Kode Arsip berhasil ditambahkan');
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
            Text::make('Kode Arsip', 'kode')
                ->rules('required'),
            Text::make('Klasifikasi', 'group')
                ->rules('required'),
            Text::make('Detail', 'detail')
                ->rules('required'),
        ];
    }
}
