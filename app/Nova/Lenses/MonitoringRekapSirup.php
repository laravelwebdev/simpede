<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\KakSp2d;
use App\Nova\Actions\UbahStatusRekap;
use App\Nova\DaftarSp2d as ResourceDaftarSp2d;
use App\Nova\KerangkaAcuan as ResourceKerangkaAcuan;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricValue;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

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
public static function query(LensRequest $request, Builder $query)
{
    return $request->withOrdering(
        $request->withFilters(
            $query
                ->whereHas('daftarSp2d', function ($q) {
                    $q->whereHas('dipa', function ($q2) {
                        $q2->where('tahun', session('year'));
                    });
                })
                ->whereHas('kerangkaAcuan', function ($q) {
                    $q->where('jenis', 'Penyedia');
                })
        )
    );
}

    /**
     * Get the fields available to the lens.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Stack::make('KAK', 'tanggal', [
                BelongsTo::make('KAK', 'kerangkaAcuan', ResourceKerangkaAcuan::class)
                    ->sortable(),
                Date::make('Tanggal KAK', 'kerangkaAcuan.naskahKeluar.tanggal')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Stack::make('SPM', 'tanggal', [
                BelongsTo::make('SPM', 'daftarSp2d', ResourceDaftarSp2d::class)
                    ->sortable()
                    ->searchable(),
                Date::make('Tanggal SPM', 'daftarSp2d.tanggal_spm')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Rincian KAK', 'kerangkaAcuan.rincian')
                ->sortable(),
            Boolean::make('Rekap Sirup', 'rekap_sirup')
                ->sortable()
                ->filterable()
                ->exceptOnForms(),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        $model = KakSp2d::query()
            ->whereHas('daftarSp2d', function ($q) {
                $q->whereHas('dipa', function ($q2) {
                    $q2->where('tahun', session('year'));
                });
            })
            ->whereHas('kerangkaAcuan', function ($q) {
                $q->where('jenis', 'Penyedia');
            });

        return [
            MetricValue::make($model, 'total-kak-non-tender')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Pencatatan Non Tender', $model, 'rekap_sirup', 'keberadaan-rekap-sirup')
                ->nullStrict(false)
                ->setAdaLabel('Sudah Dicatat')
                ->width('1/2')
                ->setTidakAdaLabel('Belum Dicatat')
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
        $actions = [];
        if (Policy::make()->allowedFor('admin,arsiparis,ppk')->get()) {
            $actions[] = UbahStatusRekap::make('sirup')
                ->showInline();
        }

        return $actions;
    }

    /**
     * Get the URI key for the lens.
     */
    public function uriKey(): string
    {
        return 'monitoring-rekap-sirup';
    }
}
