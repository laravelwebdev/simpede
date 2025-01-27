<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Nova\Filters\TriwulanFilter;
use App\Nova\Metrics\MetricKeberadaan;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
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
        $model = Helper::modelQuery($query, $triwulan);

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
        return [
            MetricKeberadaan::make('Realisasi Triwulanan', null, 'jumlah_realisasi_tw', 'keberadaan-realisasi-tw')
                ->nullStrict(false)
                ->setAdaLabel('Terisi Lengkap')
                ->setTidakAdaLabel('Belum Lengkap')
                ->refreshWhenFiltersChange(),
            MetricKeberadaan::make('Analisis Triwulanan', null, 'jumlah_analisis', 'keberadaan-analisis-tw')
                ->nullStrict(false)
                ->refreshWhenFiltersChange(),
            MetricKeberadaan::make('Tindak Lanjut Triwulanan', null, 'jumlah_tindak_lanjut', 'keberadaan-tindak-lanjut-tw')
                ->nullStrict(false)
                ->refreshWhenFiltersChange(),
        ];
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
