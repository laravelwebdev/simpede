<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\HonorKegiatan;
use App\Nova\Actions\EditRekening;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class DaftarHonorPegawai extends Resource
{
    public static $with = ['user', 'honorKegiatan'];

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarHonorPegawai>
     */
    public static $model = \App\Models\DaftarHonorPegawai::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'user.name';

    public function subtitle()
    {
        return 'Kegiatan: '.$this->honorKegiatan->kegiatan;
    }

    public static $search = [
        'user.name',
        'user.nip',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Nama Pegawai', 'user_id')
                ->rules('required')
                ->searchable()
                ->options(Helper::setOptionPengelola('anggota', optional(HonorKegiatan::where('id', $request->viaResourceId)->first())->tanggal_spj))
                ->updateRules('required', Rule::unique('daftar_honor_pegawais', 'user_id')->where('honor_kegiatan_id', $request->viaResourceId)->ignore($this->id))
                ->creationRules('required', Rule::unique('daftar_honor_pegawais', 'user_id')->where('honor_kegiatan_id', $request->viaResourceId))
                ->onlyOnForms(),
            BelongsTo::make('Nama Pegawai', 'user', User::class)
                ->exceptOnForms(),
            Number::make('Jumlah', 'volume')
                ->step(1)
                ->rules('required', 'gt:0', 'lte:65535')
                ->help('Kosongkan jika pegawai tidak diberi honor'),
            Numeric::make('Harga Satuan', 'harga_satuan')
                ->hide()
                ->dependsOn(['volume'], function (Numeric $field, NovaRequest $request, FormData $formData) {
                    if ($formData->volume != null) {
                        $field->show();
                        $field->rules('required', 'gt:0', 'lte:16777215');
                    }
                }),
            Numeric::make('Bruto', fn () => $this->volume * $this->harga_satuan)
                ->exceptOnForms(),
            Number::make('Persentase Pajak (%)', 'persen_pajak')
                ->hide()
                ->step(0.01)
                ->dependsOn(['volume', 'user_id'], function (Number $field, NovaRequest $request, FormData $formData) {
                    if ($formData->volume != null) {
                        $field->show();
                        $field->rules('required');
                        $field->setvalue(Helper::PAJAK_GOLONGAN[optional(Helper::getDataPegawaiByUserId($formData->user_id, optional(HonorKegiatan::where('id', $request->viaResourceId)->first())->tanggal_spj))->golongan ?? 'I/a']);
                    }
                })->onlyOnForms(),
            Numeric::make('Pajak', fn () => round($this->volume * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
                ->exceptOnForms(),
            Numeric::make('Netto', fn () => $this->volume * $this->harga_satuan - round($this->volume * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
                ->exceptOnForms(),
            Select::make('Bank', 'user.kode_bank_id')
                ->options(Helper::setOptionsKodeBank())
                ->displayUsingLabels()
                ->onlyOnIndex(),
            Text::make('Rekening', 'user.rekening')
                ->onlyOnIndex(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            $actions[] =
                EditRekening::make('pegawai')->onlyInline();
        }

        return $actions;
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId;
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId;
    }
}
