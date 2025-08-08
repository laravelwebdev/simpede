<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\PulsaKegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddPulsaKegiatan extends Action
{
    use InteractsWithQueue, Queueable;

    public function name()
    {
        return 'Tambahkan Pulsa Kegiatan';
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $kak = $models->first();
        $pulsa = new PulsaKegiatan;
        $pulsa->kerangka_acuan_id = $kak->id;
        $pulsa->unit_kerja_id = Helper::getDataPegawaiByUserId(Auth::user()->id, now())->unit_kerja_id;
        $pulsa->kegiatan = $kak->kegiatan;
        $pulsa->save();

        return ActionResponse::visit('/resources/pulsa-kegiatans/'.$pulsa->id.'/edit');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
        ];
    }
}
