<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\HonorKegiatan;
use App\Nova\Actions\EditRekening;
use App\Nova\Actions\ImportDaftarHonorMitra;
use App\Nova\Lenses\RekapHonorMitra;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarHonorMitra extends Resource
{
    public static $perPageViaRelationship = 10;

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarHonorMitra>
     */
    public static $model = \App\Models\DaftarHonorMitra::class;

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
        'nik', 'nama',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $mitra = Helper::getMitraById($this->mitra_id);
        $kegiatan = HonorKegiatan::find($this->honor_kegiatan_id);
        if ($request->viaResource === 'honor-kegiatans') {
            return [
            Text::make('Nama', fn () => $mitra->nama)
                ->onlyOnIndex(),
            Text::make('Golongan', fn () => '-')
                ->onlyOnIndex(),
            Number::make('Jumlah', 'volume')
                ->onlyOnIndex(),
            Currency::make('Harga Satuan', 'harga_satuan')
                ->currency('IDR')
                ->locale('id')
                ->onlyOnIndex(),
            Currency::make('Bruto', fn () => $this->volume * $this->harga_satuan)
                ->currency('IDR')
                ->locale('id')
                ->onlyOnIndex(),
            Currency::make('Pajak', fn () => round($this->volume * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
                ->currency('IDR')
                ->locale('id')
                ->onlyOnIndex(),
            Currency::make('Netto', fn () => $this->volume * $this->harga_satuan - round($this->volume * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
                ->currency('IDR')
                ->locale('id')
                ->onlyOnIndex(),
            Text::make('Rekening', fn () => $mitra->rekening)
                ->onlyOnIndex(),
            ];
        }

        return [
            Text::make('Kegiatan', fn () => $kegiatan->kegiatan)
            ->onlyOnIndex(),
            Number::make('Jumlah', 'volume')
            ->onlyOnIndex(),
            Currency::make('Harga Satuan', 'harga_satuan')
            ->currency('IDR')
            ->locale('id')
            ->onlyOnIndex(),
            Currency::make('Bruto', fn () => $this->volume * $this->harga_satuan)
            ->currency('IDR')
            ->locale('id')
            ->onlyOnIndex(),
            Currency::make('Pajak', fn () => round($this->volume * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
            ->currency('IDR')
            ->locale('id')
            ->onlyOnIndex(),
            Currency::make('Netto', fn () => $this->volume * $this->harga_satuan - round($this->volume * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
            ->currency('IDR')
            ->locale('id')
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
        return [
            RekapHonorMitra::make(11,2024,1),
 
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if ($request->viaResource === 'honor-kegiatans') {
            if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
                $actions[] =
                    EditRekening::make('mitra')->onlyInline();
            }
            if (Policy::make()->allowedFor('koordinator,anggota')->get() && $request->viaResourceId) {
                $actions[] =
                    ImportDaftarHonorMitra::make($request->viaResourceId)
                        ->standalone()
                        ->confirmButtonText('Import');
            }
        }       

        return $actions;
    }
}
