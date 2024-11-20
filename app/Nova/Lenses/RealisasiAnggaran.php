<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Nova\Filters\BulanFilter;
use App\Nova\Filters\RoFilter;
use App\Nova\Metrics\RealisasiPerJenisBelanja;
use App\Nova\Metrics\SerapanAnggaran;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
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
        return 'Realisasi SP2D per '.Helper::terbilangTanggal(Dipa::cache()->get('all')->where('tahun', session('year'))->first()->tanggal_realisasi);
    }

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        $dipa_id = Dipa::cache()->get('all')->where('tahun', session('year'))->first()->id;
        $filtered_bulan = Helper::parseFilterFromUrl(request()->headers->get('referer'), 'realisasi-anggarans_filter', 'App\\Nova\\Filters\\BulanFilter', date('m'));

        return $request->withOrdering($request->withFilters(
            $query->fromSub(fn ($query) => $query->from('realisasi_anggarans')->selectRaw(
                'mak, 
                mata_anggarans.uraian as item, 
                total, 
                blokir,
                ordered,
                CASE WHEN SUM(nilai) IS NULL THEN 0 ELSE SUM(nilai) END as realisasi, 
                CASE WHEN SUM(nilai) IS NULL THEN 0 ELSE round(100*sum(nilai)/total,2) END as persen, 
                CASE WHEN SUM(nilai) IS NULL THEN total-blokir ELSE  total- SUM(nilai)-blokir END as sisa'
            )

                ->rightJoin('mata_anggarans', function ($join) use ($filtered_bulan) {
                    $join->on('realisasi_anggarans.mata_anggaran_id',
                        '=',
                        'mata_anggarans.id')
                        ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                            return $query->whereMonth('tanggal_sp2d', '<=', $filtered_bulan);
                        });
                })
                ->where('mata_anggarans.dipa_id', $dipa_id)

                ->groupBy('mak')
                ->groupBy('item')
                ->groupBy('blokir')
                ->groupBy('total')
                ->groupBy('ordered')
                ->orderBy('mak')
                ->orderBy('ordered'),
                'realisasi_anggarans')
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Stack::make('RO/Komponen', [
                Line::make('RO', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value, 'ro'))->asSubTitle(),
                Line::make('Komponen', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value, 'komponen'))->asSmall(),
            ]),
            Stack::make('Akun/Detil', [
                Line::make('Akun', 'mak')
                    ->displayUsing(fn ($value) => Helper::getDetailAnggaran($value))->asSubTitle(),
                Line::make('Item', 'item')->asSmall(),
            ]),
            Text::make('COA', 'coa_id'),
            Number::make('Total', 'total')
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('Realisasi', 'realisasi')
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('% Realisasi', 'persen'),
            Number::make('Blokir', 'blokir')
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Number::make('Sisa', 'sisa')
                ->displayUsing(fn ($value) => Helper::formatUang($value)),
            Url::make('Detail', function () {
                $filter = base64_encode(
                    json_encode(
                        [
                            [
                                'Hidden:mata_anggaran_id' => $this->mata_anggaran_id,
                            ],
                        ],
                        true
                    )
                );

                return Nova::path().'/resources/realisasi-anggarans?realisasi-anggarans_filter='.$filter;
            })
                ->label('Lihat')
                ->clickable()
                ->canSee(fn () => $this->realisasi > 0)
                ->sameTab(),

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
