<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class MonitoringDigitalPayment extends Lens
{
    public $name = 'CMS & KKP Belum Bayar';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['kerangkaAcuan.rincian', 'jenis'];

    /**
     * Get the query builder / paginator for the lens.
     */
    public static function query(LensRequest $request, Builder $query): Builder|Paginator
    {
        return $request->withOrdering($request->withFilters(
            $query->whereNull('tanggal_pembayaran')
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
            Date::make('Tanggal Transaksi', 'tanggal_transaksi')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->onlyOnIndex(),
            Text::make('Uraian', 'kerangkaAcuan.rincian')
                ->sortable()
                ->onlyOnIndex(),
            Select::make('Jenis Pembayaran', 'jenis')
                ->options(Helper::JENIS_DIGITAL_PAYMENT)
                ->sortable()
                ->displayUsingLabels()
                ->filterable()
                ->onlyOnIndex(),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [];
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
        return 'monitoring-digital-payment';
    }
}
