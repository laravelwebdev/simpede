<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\HonorKegiatan;
use App\Nova\Actions\AddHasManyModel;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarHonorPegawai extends Resource
{
    public static $perPageViaRelationship = 10;
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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nip', 'nama',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fieldsforIndex(NovaRequest $request)
    {
        return [
            Text::make('NIP', 'nik')
                ->readOnly(),
            Text::make('Nama', 'nama')
                ->readOnly(),
            Text::make('Golongan')
                ->readOnly(),
            Number::make('Jumlah', 'volume')
                ->readOnly(),
            Currency::make('Harga Satuan', 'harga_satuan')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Currency::make('Bruto', 'bruto')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Currency::make('Pajak', 'pajak')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Currency::make('Netto', 'netto')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Text::make('Rekening', 'rekening')
                ->rules('required')->readOnly(),
        ];
    }

    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Nama Pegawai','nik')
                ->rules('required')
                ->searchable()
                ->options(Helper::setOptionPengelolaWithNip('anggota',HonorKegiatan::where('id', $request->viaResourceId)->first()->tanggal_spj))
                ->creationRules('unique:daftar_honor_pegawais,nik')
                ->updateRules('unique:daftar_honor_pegawais,nik,{{resourceId}}'), //berdasarkan tanggal akhir kegiatan
            Number::make('Jumlah', 'volume')
                ->step(1),
            Currency::make('Harga Satuan', 'harga_satuan')
                ->currency('IDR')
                ->locale('id')
                ->step(1),
            Number::make('Persentase Pajak (%)', 'pajak'),
            Text::make('Rekening', 'rekening')
                ->help('Contoh Penulisan Rekening: BRI 123456788089'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            AddHasManyModel::make('DaftarHonorPegawai', 'HonorKegiatan', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone()
                ->addFields($this->fields($request)),
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/honor-kegiatans/'.$request->viaResourceId.'#Detail=daftar-honor-pegawai';
    }
}
