<?php

namespace App\Nova\Lenses;

use App\Nova\Metrics\PembukuanBarangPersediaan;
use App\Nova\Metrics\StatusPembelianPersediaan;
use App\Nova\Metrics\StatusPermintaanPersediaan;
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
        return $request->withoutTableOrderPrefix()->withOrdering($request->withFilters(
            $query->select(self::columns())
                ->whereNotNull('tanggal_transaksi')
                ->havingRaw('stok > 0')
                ->join(
                    'barang_persediaans',
                    'master_persediaans.id',
                    '=',
                    'barang_persediaans.master_persediaan_id'
                )
                ->groupBy('master_persediaan_id')
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
        return [
            PembukuanBarangPersediaan::make()
                ->help('Proporsi Barang Persediaan berdasarkan penentuan tanggal bukunya'),
            StatusPembelianPersediaan::make()
                ->help('Daftar Pembelian Barang Persediaan berdasarkan statusnya'),
            StatusPermintaanPersediaan::make()
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
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
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
