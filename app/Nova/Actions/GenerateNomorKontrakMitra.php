<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\NaskahDefault;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class GenerateNomorKontrakMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Generate Nomor Kontrak Mitra';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->tanggal_spk = Helper::createDateFromString($fields->tanggal_spk);
            $model->awal_kontrak = Helper::createDateFromString($fields->awal_kontrak);
            $model->akhir_kontrak = Helper::createDateFromString($fields->akhir_kontrak);
            $model->spk_ppk_user_id = $fields->ppk_user_id;
            $model->spk_kode_arsip_id = $fields->kode_arsip_id;
            $model->save();
        }

        return Action::message('Nomor Kontrak Sukses Digenerate');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Date::make('Tanggal SPK', 'tanggal_spk')
                ->rules('required', 'before_or_equal:awal_kontrak', 'before_or_equal:today'),
            Date::make('Tanggal Mulai Pelaksanaan Kontrak', 'awal_kontrak')
                ->rules('required', 'after_or_equal:tanggal_spk'),
            Date::make('Tanggal Selesai Kontrak', 'akhir_kontrak')
                ->rules('required', 'after_or_equal:awal'),
            Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                ->rules('required')
                ->searchable()
                ->dependsOn(['tanggal_spk'], function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('ppk', $formData->date('tanggal_spk')))
                        ->default(Helper::setDefaultPengelola('ppk', $formData->date('tanggal_spk')));
                }),
            Select::make('Klasifikasi Arsip', 'kode_arsip_id')
                ->searchable()
                ->dependsOn(['tanggal_spk'], function (Select $field, NovaRequest $request, FormData $formData) {
                    $default_naskah = NaskahDefault::cache()
                        ->get('all')
                        ->where('jenis', 'kontrak')
                        ->first();
                    $field->rules('required')
                        ->options(Helper::setOptionsKodeArsip($formData->tanggal_spk, optional($default_naskah)->kode_arsip_id));
                }),

        ];
    }
}
