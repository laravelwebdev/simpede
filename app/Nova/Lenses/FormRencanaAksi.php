<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Models\PerjanjianKinerja;
use App\Nova\Filters\TriwulanFilter;
use App\Nova\Metrics\MetricKeberadaan;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class FormRencanaAksi extends Lens
{
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['indikator'];

    /**
     * Get the query builder / paginator for the lens.
     */
    public static function query(LensRequest $request, Builder $query): Builder|Paginator
    {
        $triwulan = Helper::parseFilter($request->query->get('filters'), 'App\\Nova\\Filters\\TriwulanFilter', '1') ?: (string) now()->quarter;
        $model = self::modelQuery($query, $triwulan);

        return $request->withOrdering($request->withFilters(
            $model
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Text::make('Indikator', 'indikator'),
            Number::make('Realisasi Triwulan', 'realisasi_triwulan'),
            Number::make('Realisasi Tahunan', 'realisasi_tahun'),
            Boolean::make('Realisasi', 'jumlah_realisasi_tw')->falseValue(0),
            Boolean::make('Analisis', 'jumlah_analisis')->falseValue(0),
            Boolean::make('Tindak Lanjut', 'jumlah_tindak_lanjut')->falseValue(0),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        $triwulan = (string) now()->quarter;
        $model = self::modelQuery(PerjanjianKinerja::query(), $triwulan);

        return [
            MetricKeberadaan::make('Realisasi TW '.$triwulan, $model, 'jumlah_realisasi_tw', 'keberadaan-realisasi-tw')
                ->nullStrict(false)
                ->setAdaLabel('Terisi Lengkap')
                ->setTidakAdaLabel('Belum Lengkap')
                ->refreshWhenFiltersChange(),
            MetricKeberadaan::make('Analisis TW '.$triwulan, $model, 'jumlah_analisis', 'keberadaan-analisis-tw')
                ->nullStrict(false)
                ->refreshWhenFiltersChange(),
            MetricKeberadaan::make('Tindak Lanjut TW '.$triwulan, $model, 'jumlah_tindak_lanjut', 'keberadaan-tindak-lanjut-tw')
                ->nullStrict(false)
                ->refreshWhenFiltersChange(),
        ];
    }

    private static function modelQuery($model, $triwulan)
    {
        $bulan = match ($triwulan) {
            '1' => [1, 2, 3],
            '2' => [4, 5, 6],
            '3' => [7, 8, 9],
            '4' => [10, 11, 12],
        };

        return $model->select(
            'perjanjian_kinerjas.id',
            'perjanjian_kinerjas.indikator',
            DB::raw('ROUND(AVG(CASE WHEN realisasi_kinerjas.realisasi_tw'.$triwulan.' / realisasi_kinerjas.target_tw'.$triwulan.' * 100 > 120 THEN 120 ELSE realisasi_kinerjas.realisasi_tw'.$triwulan.' / realisasi_kinerjas.target_tw'.$triwulan.' * 100 END), 2) AS realisasi_triwulan'),
            DB::raw('ROUND(AVG(CASE WHEN realisasi_kinerjas.realisasi_tw'.$triwulan.' / realisasi_kinerjas.target_tw4 * 100 > 120 THEN 120 ELSE realisasi_kinerjas.realisasi_tw'.$triwulan.' / realisasi_kinerjas.target_tw4 * 100 END), 2) AS realisasi_tahun'),
            DB::raw('IF(COUNT(CASE WHEN realisasi_kinerjas.realisasi_tw'.$triwulan.' IS NULL THEN 1 END) > 0, 0, 1) AS jumlah_realisasi_tw'),
            DB::raw('COUNT(DISTINCT tindak_lanjuts.id) AS jumlah_tindak_lanjut'),
            DB::raw('COUNT(DISTINCT analisis_sakips.id) AS jumlah_analisis')
        )
            ->leftJoin('realisasi_kinerjas', function ($join) {
                $join->on('perjanjian_kinerjas.id', '=', 'realisasi_kinerjas.perjanjian_kinerja_id')
                    ->where('realisasi_kinerjas.is_indikator', true);
            })
            ->leftJoin('tindak_lanjuts', function ($join) use ($triwulan) {
                $join->on('realisasi_kinerjas.unit_kerja_id', '=', 'tindak_lanjuts.unit_kerja_id')
                    ->where('tindak_lanjuts.triwulan', $triwulan);
            })
            ->leftJoin('analisis_sakip_perjanjian_kinerja', 'perjanjian_kinerjas.id', '=', 'analisis_sakip_perjanjian_kinerja.perjanjian_kinerja_id')
            ->leftJoin('analisis_sakips', function ($join) use ($bulan) {
                $join->on('analisis_sakip_perjanjian_kinerja.analisis_sakip_id', '=', 'analisis_sakips.id')
                    ->whereIn('bulan', $bulan);
            })
            ->where('perjanjian_kinerjas.tahun', session('year'))
            ->groupBy('perjanjian_kinerjas.id', 'perjanjian_kinerjas.indikator');
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [
            TriwulanFilter::make(),
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     */
    public function uriKey(): string
    {
        return 'form-rencana-aksi';
    }
}
