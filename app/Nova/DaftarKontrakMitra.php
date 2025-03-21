<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\Download;
use App\Nova\Filters\StatusFilter;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class DaftarKontrakMitra extends Resource
{
    public static $displayInNavigation = false;

    public static $with = ['kontrakNaskahKeluar', 'bastNaskahKeluar', 'daftarHonorMitra', 'mitra', 'kontrakMitra'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarKontrakMitra>
     */
    public static $model = \App\Models\DaftarKontrakMitra::class;

    public static function label()
    {
        return 'Daftar Kontrak Mitra';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'mitra.nama';

    public function subtitle()
    {
        return $this->KontrakMitra->nama_kontrak.': '.Helper::formatRupiah($this->nilai_kontrak);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'mitra.nama',
        'mitra.nik',
        'status_kontrak',
        'status_bast',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Mitra')
                ->exceptOnForms()
                ->sortable(),
            BelongsTo::make('Nomor Kontrak', 'kontrakNaskahKeluar', NaskahKeluar::class)
                ->readOnly()
                ->sortable()
                ->hideFromIndex($request->viaResource == 'bast-mitras')
                ->hideFromDetail($request->viaResource == 'bast-mitras'),
            BelongsTo::make('Nomor BAST', 'bastNaskahKeluar', NaskahKeluar::class)
                ->readOnly()
                ->sortable()
                ->hideFromIndex($request->viaResource == 'kontrak-mitras')
                ->hideFromDetail($request->viaResource == 'kontrak-mitras'),
            Number::make('Jumlah Kegiatan', 'jumlah_kegiatan')
                ->readOnly()
                ->sortable(),
            Numeric::make('Nilai Kontrak')
                ->readOnly()
                ->sortable(),
            Status::make('Status Kontrak', 'status_kontrak')
                ->loadingWhen(['dibuat', 'diupdate'])
                ->failedWhen(['outdated'])
                ->onlyOnIndex()
                ->hideFromIndex($request->viaResource == 'bast-mitras')
                ->hideFromDetail($request->viaResource == 'bast-mitras'),
            Status::make('Status BAST ', 'status_bast')
                ->loadingWhen(['dibuat', 'diupdate'])
                ->failedWhen(['outdated'])
                ->onlyOnIndex()
                ->hideFromIndex($request->viaResource == 'kontrak-mitras')
                ->hideFromDetail($request->viaResource == 'kontrak-mitras'),
            Boolean::make('Sesuai SBML', 'valid_sbml')
                ->exceptOnForms()
                ->filterable(),
            Boolean::make('Jumlah Kontrak', 'valid_jumlah_kontrak')
                ->exceptOnForms()
                ->filterable(),
            HasMany::make('Daftar Honor Mitra'),
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
        $filters = [];
        if ($request->viaResource == 'bast-mitras') {
            $filters[] = StatusFilter::make('daftar_kontrak_mitras', 'status_bast');
        }
        if ($request->viaResource == 'kontrak-mitras') {
            $filters[] = StatusFilter::make('daftar_kontrak_mitras', 'status_kontrak');
        }

        return $filters;
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
        if (Policy::make()->allowedFor('ppk')->get()) {
            if ($request->viaResource == 'bast-mitras') {
                $actions[] =
                    Download::make('bast', 'Unduh BAST')
                        ->showInline()
                        ->showOnDetail()
                        ->confirmButtonText('Unduh');
            }
            if ($request->viaResource == 'kontrak-mitras') {
                $actions[] =
                    Download::make('kontrak', 'Unduh Kontrak')
                        ->showInline()
                        ->showOnDetail()
                        ->confirmButtonText('Unduh');
            }
        }

        return $actions;
    }
}
