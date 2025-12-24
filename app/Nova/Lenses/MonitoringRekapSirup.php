<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Models\KerangkaAcuan;
use App\Nova\Actions\UbahStatusRekap;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricTrend;
use App\Nova\NaskahKeluar;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;
use Laravelwebdev\Numeric\Numeric;

class MonitoringRekapSirup extends Lens
{
    public $name = 'Monitoring Rekap Pencatatan Non Tender';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'naskahKeluar.nomor', 'tanggal', 'rincian', 'status',
    ];

    /**
     * Get the query builder / paginator for the lens.
     */
    public static function query(LensRequest $request, Builder $query): Builder|Paginator
    {
        return $request->withOrdering($request->withFilters(
            $query
                ->join('dipas', 'dipas.id', '=', 'kerangka_acuans.dipa_id')
                ->where('dipas.tahun', session('year'))
                ->select('kerangka_acuans.*')
                ->distinct('kerangka_acuans.id')
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
            // ID::make(__('ID'), 'id')->sortable(),
            Stack::make('Nomor/Tanggal', 'tanggal', [
                BelongsTo::make('Nomor', 'naskahKeluar', NaskahKeluar::class),
                Date::make('Tanggal KAK', 'tanggal')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Rincian'),
            Numeric::make('Perkiraan', 'anggaran')
                ->sortable(),
            BelongsTo::make('Unit Kerja')
                ->filterable(),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat'])
                ->failedWhen(['outdated']),
            Boolean::make('Pencatatan Sirup', 'rekap_sirup')->filterable(),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        $dipaId = Dipa::where('tahun', session('year'))->pluck('id');
        $model = KerangkaAcuan::whereIn('dipa_id', $dipaId);

        return [
            MetricKeberadaan::make('Pencatatan Non Tender', $model, 'rekap_sirup', 'keberadaan-rekap-sirup')
                ->nullStrict(false)
                ->setAdaLabel('Sudah Dicatat')
                ->width('1/2')
                ->setTidakAdaLabel('Belum Dicatat')
                ->refreshWhenActionsRun(),
            MetricTrend::make($model, 'tanggal', 'trend-rekap-sirup')
                ->width('1/2')
                ->refreshWhenActionsRun(),
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

        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [
            UbahStatusRekap::make('sirup')
                ->showInline(),
        ];
    }

    /**
     * Get the URI key for the lens.
     */
    public function uriKey(): string
    {
        return 'monitoring-rekap-sirup';
    }
}
