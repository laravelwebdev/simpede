<?php

namespace App\Nova\Lenses;

use App\Helpers\Policy;
use App\Models\BarangPersediaan;
use App\Models\PembelianPersediaan;
use App\Models\PermintaanPersediaan;
use App\Nova\Actions\Download;
use App\Nova\Filters\Keberadaan;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricPartition;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class RekapBarangPersediaan extends Lens
{
    public function name()
    {
        return 'Barang Persediaan';
    }

    public static $showPollingToggle = true;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['kode', 'barang'];

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        $displayed = DB::table('barang_persediaans')
            ->select('master_persediaan_id')
            ->distinct();

        return $request->withOrdering($request->withFilters(
            $query->fromSub(fn ($query) => $query->from('master_persediaans')->select(self::columns())
                ->join('barang_persediaans', function ($join) {
                    $join->on('master_persediaans.id',
                        '=',
                        'barang_persediaans.master_persediaan_id')
                        ->whereNotNull('tanggal_transaksi');
                })
                ->groupBy('master_persediaans.id', 'master_persediaans.kode', 'master_persediaans.satuan', 'master_persediaans.barang')
                ->joinSub($displayed, 'displayed', function (JoinClause $join) {
                    $join->on('displayed.master_persediaan_id', '=', 'master_persediaans.id');
                }), 'master_persediaans')
        ));
    }

    /**
     * Get the columns that should be selected.
     *
     * @return array
     */
    protected static function columns()
    {
        return [
            'master_persediaans.id',
            'master_persediaans.kode',
            'master_persediaans.satuan',
            'master_persediaans.barang',
            DB::raw('SUM(CASE WHEN tanggal_transaksi IS NOT NULL AND (barang_persediaanable_type = "App\\\Models\\\PembelianPersediaan" OR  barang_persediaanable_type = "App\\\Models\\\PersediaanMasuk") THEN volume ELSE 0 END) -  SUM(CASE WHEN barang_persediaanable_type = "App\\\Models\\\PermintaanPersediaan" OR  barang_persediaanable_type = "App\\\Models\\\PersediaanKeluar"THEN volume ELSE 0 END) as stok'),
        ];
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            // ID::make()->sortable(),
            Text::make('Kode')
                ->sortable()
                ->readOnly(),
            Text::make('Barang')
                ->sortable()
                ->readOnly(),
            Text::make('stok', 'stok', function ($value) {
                return $value.' '.$this->satuan;
            })
                ->sortable(),

        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $modelPembelian = PembelianPersediaan::class;

        $modelPermintaan = PermintaanPersediaan::class;

        $modelPersediaan = BarangPersediaan::class;

        return [
            MetricKeberadaan::make('Pembukuan Persediaan', $modelPersediaan, 'tanggal_transaksi', 'keberadaan-pembukuan-persediaan')
                ->help('Proporsi Barang Persediaan berdasarkan penentuan tanggal bukunya'),
            MetricPartition::make($modelPembelian, 'status', '-lens-status-pembelian-persediaan', 'Status Pembelian')
                ->refreshWhenActionsRun()
                ->failedWhen(['outdated'])
                ->successWhen(['dicetak'])
                ->help('Daftar Pembelian Barang Persediaan berdasarkan statusnya'),
            MetricPartition::make($modelPermintaan, 'status', '-lens-status-permintaan-persediaan', 'Status Permintaan')
                ->refreshWhenActionsRun()
                ->failedWhen(['outdated'])
                ->successWhen(['dicetak'])
                ->help('Daftar Permintaan Barang Persediaan berdasarkan statusnya'),
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
            Keberadaan::make('Stok', 'stok'),
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('kasubbag,bmn')->get()) {
            $actions[] =
            Download::make('karken_persediaan', 'Unduh Kartu Kendali Persediaan')
                ->showInline()
                ->showOnDetail()
                ->withOptionPengelola('bmn')
                ->confirmButtonText('Unduh');
        }

        return $actions;
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'rekap-barang-persediaan';
    }
}
