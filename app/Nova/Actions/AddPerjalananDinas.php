<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\PerjalananDinas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddPerjalananDinas extends Action
{
    use InteractsWithQueue, Queueable;

    public function name()
    {
        return 'Tambahkan Perjalalan Dinas';
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
        $kak = $models->first();
        $perjalanan = new PerjalananDinas;
        $perjalanan->kerangka_acuan_id = $kak->id;
        $perjalanan->tanggal_berangkat = $kak->awal;
        $perjalanan->tanggal_kembali = $kak->akhir;
        $perjalanan->uraian = $kak->rincian;
        $perjalanan->save();

        return ActionResponse::redirect('perjalanan-dinas/'.$perjalanan->id.'/edit');

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
        ];
    }
}
