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

class GenerateNomorBastMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Generate Nomor BAST Mitra';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $error = false;
        foreach ($models as $model) {
            if ($model->akhir_kontrak >= Helper::createDateFromString($fields->tanggal_bast)) {
                $model->tanggal_bast = Helper::createDateFromString($fields->tanggal_bast);
                $model->bast_ppk_user_id = $fields->ppk_user_id;
                $model->bast_kode_arsip_id = $fields->kode_arsip_id;
                $model->save();
            } else {
                $error = true;
            }
        }

        return ! $error ? Action::message('Nomor BAST Sukses Digenerate') : Action::danger('Cek Kembali! Terdapat Tanggal BAST yang Melewati Tanggal Akhir Kontrak');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Date::make('Tanggal BAST', 'tanggal_bast')
                ->rules('required', 'before_or_equal:today'),
            Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                ->rules('required')
                ->searchable()
                ->dependsOn(['tanggal_bast'], function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('ppk', $formData->date('tanggal_bast')))
                        ->default(Helper::setDefaultPengelola('ppk', $formData->date('tanggal_bast')));
                }),
            Select::make('Klasifikasi Arsip', 'kode_arsip_id')
                ->searchable()
                ->dependsOn(['tanggal_bast'], function (Select $field, NovaRequest $request, FormData $formData) {
                    $default_naskah = NaskahDefault::cache()
                        ->get('all')
                        ->where('jenis', 'bast')
                        ->first();
                    $field->rules('required')
                        ->options(Helper::setOptionsKodeArsip($formData->tanggal_bast, optional($default_naskah)->kode_arsip_id));
                }),

        ];
    }
}
