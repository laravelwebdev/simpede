<?php

namespace App\Nova\Actions;

use App\Models\DaftarKontrakMitra;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class GenerateBastMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Generate BAST Mitra';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $daftar_kontraks = DaftarKontrakMitra::where('kontrak_mitra_id', $model->kontrak_mitra_id)->get();
        foreach ($daftar_kontraks as $daftar_kontrak) {
            $daftar_kontrak->bast_mitra_id = $model->id;
            if ($daftar_kontrak->status_bast === 'outdated') {
                $daftar_kontrak->status_bast = 'diupdate';
            }
            $daftar_kontrak->save();
        }
        $model::where('id', $model->id)->update(['status' => 'digenerate']);

        return Action::message('BAST Sukses Digenerate');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
