<?php

namespace App\Nova\Lenses;

use App\Helpers\Policy;
use App\Nova\Actions\Download;
use App\Nova\Filters\Keberadaan;
use App\Nova\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;
use Laravelwebdev\Greeter\Greeter;

class PemeliharaanBarang extends Lens
{
    public function name()
    {
        return 'Pemeliharaan BMN';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kode_barang', 'nup', 'nama_barang', 'merk', 'nopol', 'kondisi', 'lokasi', 'user.name',
    ];

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->fromSub(fn ($query) => $query->from('master_barang_pemeliharaans')
                ->where('tahun', session('year'))
                ->select(self::columns())
                ->leftJoin('daftar_pemeliharaans', 'daftar_pemeliharaans.master_barang_pemeliharaan_id', '=', 'master_barang_pemeliharaans.id')
                ->groupBy('kode_barang', 'nup', 'nama_barang', 'merk', 'nopol', 'user_id', 'kondisi', 'lokasi', 'master_barang_pemeliharaans.id'), 'master_barang_pemeliharaans')

        ), fn ($query) => $query->orderBy('jumlah', 'desc')
            ->orderBy('kode_barang', 'asc')
            ->orderBy('nup', 'asc'));
    }

    /**
     * Get the columns that should be selected.
     *
     * @return array
     */
    protected static function columns()
    {
        return [
            'master_barang_pemeliharaans.id',
            'master_barang_pemeliharaans.kode_barang',
            'master_barang_pemeliharaans.nup',
            'master_barang_pemeliharaans.nama_barang',
            'master_barang_pemeliharaans.merk',
            'master_barang_pemeliharaans.nopol',
            'master_barang_pemeliharaans.kondisi',
            'master_barang_pemeliharaans.lokasi',
            'master_barang_pemeliharaans.user_id',
            DB::raw('SUM(CASE WHEN YEAR(daftar_pemeliharaans.tanggal) = '.session('year').' THEN 1 ELSE 0 END) as jumlah'),
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
            Text::make('Kode Barang')
                ->sortable()
                ->readonly(),
            Number::make('NUP')
                ->sortable()
                ->step(1)
                ->readonly(),
            Text::make('Nama Barang')
                ->sortable()
                ->readonly(),
            Text::make('Merk')
                ->showWhenPeeking()
                ->sortable()
                ->readonly(),
            Text::make('Nopol')
                ->showWhenPeeking()
                ->sortable()
                ->readonly(),
            Select::make('Kondisi')
                ->options([
                    'Baik' => 'Baik',
                    'Rusak Ringan' => 'Rusak Ringan',
                ])
                ->displayUsingLabels()
                ->searchable()
                ->sortable()
                ->filterable()
                ->readonly(),
            Text::make('Lokasi')
                ->sortable()
                ->readonly(),
            BelongsTo::make('Pemegang', 'user', User::class)
                ->searchable()
                ->withSubtitles(),
            Number::make('Pemeliharaan', 'jumlah')
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
            Greeter::make()
                ->user($this->getJumlahBarang().' Barang')
                ->message(text: 'Inventori')
                ->avatar(url: Storage::disk('images')->url('bar-chart.svg'))
                ->width('1/3'),
            Greeter::make()
                ->user($this->getJumlahBarangDipelihara().' Barang')
                ->message(text: 'Barang Dipelihara')
                ->avatar(url: Storage::disk('images')->url('bar-chart.svg'))
                ->width('1/3'),
            Greeter::make()
                ->user($this->getJumlahPemeliharaan().' Kegiatan')
                ->message(text: 'Kegiatan Pemeliharaan')
                ->avatar(url: Storage::disk('images')->url('bar-chart.svg'))
                ->width('1/3'),
        ];
    }

    private function getJumlahBarang()
    {
        return DB::table('master_barang_pemeliharaans')
            ->where('tahun', session('year'))
            ->select('kode_barang')
            ->count();
    }

    private function getJumlahBarangDipelihara()
    {
        return DB::table('daftar_pemeliharaans')
            ->join('master_barang_pemeliharaans', 'daftar_pemeliharaans.master_barang_pemeliharaan_id', '=', 'master_barang_pemeliharaans.id')
            ->where('master_barang_pemeliharaans.tahun', session('year'))
            ->whereYear('daftar_pemeliharaans.tanggal', session('year'))
            ->distinct('daftar_pemeliharaans.master_barang_pemeliharaan_id')
            ->count('daftar_pemeliharaans.master_barang_pemeliharaan_id');
    }

    private function getJumlahPemeliharaan()
    {
        return DB::table('daftar_pemeliharaans')
            ->join('master_barang_pemeliharaans', 'daftar_pemeliharaans.master_barang_pemeliharaan_id', '=', 'master_barang_pemeliharaans.id')
            ->where('master_barang_pemeliharaans.tahun', session('year'))
            ->whereYear('daftar_pemeliharaans.tanggal', session('year'))
            ->count('daftar_pemeliharaans.master_barang_pemeliharaan_id');
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            Keberadaan::make('Jumlah Pemeliharaan', 'jumlah'),
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
            Download::make('karken_pemeliharaan', 'Unduh Kartu Kendali Pemeliharaan')
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
        return 'pemeliharaan-barang';
    }
}
