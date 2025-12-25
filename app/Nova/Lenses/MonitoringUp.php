<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Nova\Metrics\MonitoringKkp;
use App\Nova\Metrics\MonitoringUpPerJenis;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;
use Laravelwebdev\Numeric\Numeric;

class MonitoringUp extends Lens
{
    public $name = 'Daftar SP2D UP/TUP';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenis', 'nomor_sp2d', 'nilai', 'tanggal',
    ];

    /**
     * Get the query builder / paginator for the lens.
     */
    public static function query(LensRequest $request, Builder $query): Builder|Paginator
    {
        $dipa = Dipa::cache()
            ->get('all')
            ->where('tahun', session('year'))
            ->first();

        return $request->withOrdering($request->withFilters(
            $query->where('dipa_id', optional($dipa)->id)
        ), fn ($query) => $query->orderBy('tanggal', 'desc'));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Date::make('Tanggal SP2D', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Text::make('Jenis', 'jenis')
                ->sortable()
                ->rules('required'),
            Text::make('Nomor SP2D', 'nomor_sp2d')
                ->sortable()
                ->copyable()
                ->rules('required'),
            Numeric::make('Nilai UP', 'nilai')
                ->sortable(),
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
            MonitoringUpPerJenis::make()->width('1/2'),
            MonitoringKkp::make()->width('1/2'),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [];
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
        return 'monitoring-up';
    }
}
