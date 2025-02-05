<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Nova\Filters\BulanFilter;
use App\Nova\Filters\RoFilter;
use App\Nova\Metrics\RealisasiPerJenisBelanja;
use App\Nova\Metrics\SerapanAnggaran;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Nova;

class RealisasiAnggaran extends Lens
{
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'mak',
    ];

    public function name()
    {
        $tanggal = Helper::terbilangTanggal(Helper::getPropertyFromCollection(Dipa::cache()->get('all')->where('tahun', session('year'))->first(), 'tanggal_realisasi'));

        return $tanggal ? 'Realisasi SP2D per '.Helper::terbilangTanggal(Dipa::cache()->get('all')->where('tahun', session('year'))->first()->tanggal_realisasi) : 'Realisasi SP2D';
    }

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        $dipa_id = Helper::getPropertyFromCollection(Dipa::cache()->get('all')->where('tahun', session('year'))->first(), 'id');
        $filtered_bulan = Helper::parseFilter($request->query->get('filters'), \App\Nova\Filters\BulanFilter::class, (int) date('m'));

        return $request->withOrdering($request->withFilters(
            $query->fromSub(fn ($query) => $query->from('realisasi_anggarans')->selectRaw(
                'mak, 
                mata_anggarans.id as id_mata_anggaran,
                mata_anggarans.uraian as item, 
                total, 
                blokir,
                ordered,
                CASE WHEN SUM(nilai) IS NULL THEN 0 ELSE SUM(nilai) END as realisasi, 
                CASE WHEN SUM(nilai) IS NULL THEN 0 ELSE round(100*sum(nilai)/total,2) END as persen, 
                CASE WHEN SUM(nilai) IS NULL THEN total-blokir ELSE  total- SUM(nilai)-blokir END as sisa'
            )
                ->join('daftar_sp2ds', 'realisasi_anggarans.daftar_sp2d_id', '=', 'daftar_sp2ds.id')

                ->rightJoin('mata_anggarans', function ($join) use ($filtered_bulan) {
                    $join->on('realisasi_anggarans.mata_anggaran_id',
                        '=',
                        'mata_anggarans.id')
                        ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                            return $query->whereMonth('daftar_sp2ds.tanggal_sp2d', '<=', $filtered_bulan);
                        });
                })
                ->where('mata_anggarans.dipa_id', $dipa_id)
                ->groupBy('mak', 'item', 'id_mata_anggaran', 'blokir', 'total', 'ordered'),
                'realisasi_anggarans')
        ), fn ($query) => $query->orderBy('mak')
            ->orderBy('ordered'));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Stack::make('RO/Komponen', 'mak', [
                Line::make('RO', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value, 'ro'))->asSubTitle(),
                Line::make('Komponen', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value, 'komponen'))->asSmall(),
            ])->sortable(),
            Stack::make('Akun/Detil', 'mak', [
                Line::make('Akun', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value))->asSubTitle(),
                Line::make('Item', 'item')->asSmall(),
            ])->sortable(),
            Number::make('Total', 'total')
                ->sortable()
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('Realisasi', 'realisasi')
                ->sortable()
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('% Realisasi', 'persen')
                ->sortable(),
            Number::make('Blokir', 'blokir')
                ->sortable()
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('Sisa', 'sisa')
                ->sortable()
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            URL::make('Detail', function () {
                $filter = base64_encode(
                    json_encode(
                        [
                            [
                                'Hidden:mata_anggaran_id' => $this->id_mata_anggaran,
                            ],
                        ],
                        true
                    )
                );

                return Nova::path().'/resources/realisasi-anggarans?realisasi-anggarans_filter='.$filter;
            })
                ->displayUsing(fn () => 'Lihat')
                ->canSee(fn () => $this->realisasi > 0),

        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            SerapanAnggaran::make()
                ->help('Persentase total kumulatif serapan anggaran berdasarkan Rincian Output dan bulan realisasi')
                ->refreshWhenFiltersChange(),
            SerapanAnggaran::make('WA')
                ->help('Persentase total kumulatif serapan anggaran Dukman berdasarkan bulan realisasi')
                ->refreshWhenFiltersChange(),
            SerapanAnggaran::make('GG')
                ->help('Persentase total kumulatif serapan anggaran PPIS berdasarkan bulan realisasi')
                ->refreshWhenFiltersChange(),
            RealisasiPerJenisBelanja::make(),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            BulanFilter::make(),
            RoFilter::make(),
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [

        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'realisasi-anggaran';
    }
}
