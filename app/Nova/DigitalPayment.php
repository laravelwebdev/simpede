<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\DigitalPayment as ModelsDigitalPayment;
use App\Nova\Actions\SetPembayaranDigitalPayment;
use App\Nova\Filters\Keberadaan;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricTrend;
use App\Nova\Metrics\MetricValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class DigitalPayment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DigitalPayment>
     */
    public static $model = \App\Models\DigitalPayment::class;

    public static $with = ['kerangkaAcuan', 'kerangkaAcuan.naskahKeluar'];

    public static function label()
    {
        return 'Penggunaan ATM dan KKP';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->relationLoaded('kerangkaAcuan') && $this->kerangkaAcuan->relationLoaded('naskahKeluar')
            ? $this->kerangkaAcuan->naskahKeluar->nomor
            : $this->kerangkaAcuan()
                ->with('naskahKeluar')
                ->first()?->naskahKeluar?->nomor;
    }

    // Override subtitle() untuk akses relasi dengan aman
    public function subtitle()
    {
        $kerangka = $this->relationLoaded('kerangkaAcuan')
            ? $this->kerangkaAcuan
            : $this->kerangkaAcuan()->first();

        return $kerangka ? ($kerangka->rincian ?? 'Tidak ada uraian') : 'Tidak ada uraian';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kerangkaAcuan.rincian',
        'tanggal_transaksi',
        'tanggal_pembayaran',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Kerangka Acuan', 'kerangkaAcuan', \App\Nova\KerangkaAcuan::class)
                ->sortable()
                ->onlyOnDetail(),
            Text::make('Uraian', 'kerangkaAcuan.rincian')
                ->sortable()
                ->exceptOnForms(),
            Select::make('Jenis', 'jenis')
                ->options(Helper::JENIS_DIGITAL_PAYMENT)
                ->displayUsingLabels()
                ->rules('required')
                ->filterable()
                ->sortable(),
            Date::make('Tanggal Transaksi', 'tanggal_transaksi')
                ->rules('required')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->filterable()
                ->sortable(),
            Numeric::make('Jumlah', 'jumlah')
                ->rules('required', 'gt:0', 'numeric')
                ->sortable(),
            Boolean::make('Sudah Dibayar', fn () => ! is_null($this->tanggal_pembayaran))
                ->filterable(),
            Text::make('Nomor SP2D/SPBy', 'nomor')
                ->onlyOnDetail(),
            Date::make('Tanggal Pembayaran', 'tanggal_pembayaran')
                ->onlyOnDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsDigitalPayment::query()->whereYear('tanggal_transaksi', session('year'));

        return [
            MetricValue::make($model, 'total-digital-payment')
                ->refreshWhenActionsRun(),
            MetricTrend::make($model, 'tanggal_transaksi', 'trend-digital-payment')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Pembayaran', $model, 'nomor', 'keberadaan-digital-payment')
                ->refreshWhenActionsRun(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            Keberadaan::make('Pembayaran', 'nomor')
                ->is_null(),
        ];
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
        if (Policy::make()->allowedFor('ppk,ppspm')->get()) {
            $actions[] =
           SetPembayaranDigitalPayment::make()
               ->showInline()
               ->showOnDetail()
               ->exceptOnIndex()
               ->confirmButtonText('Ubah')
               ->canSee(function ($request) {
                   if ($request instanceof ActionRequest) {
                       return true;
                   }

                   return $this->resource instanceof Model && $this->resource->nomor == null;
               });
            $actions[] = Action::using('Batalkan Pembayaran', function (ActionFields $fields, Collection $models) {
                $models->each->update(['nomor' => null, 'tanggal_pembayaran' => null]);
            })->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Batalkan')
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->nomor !== null;
                });
        }

        return $actions;
    }
}
