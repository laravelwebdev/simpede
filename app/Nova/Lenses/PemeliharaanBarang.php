<?php

namespace App\Nova\Lenses;

use App\Helpers\Policy;
use App\Nova\Actions\Download;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;
use Orion\NovaGreeter\GreeterCard;

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
            $query->where('tahun',session('year'))
                ->select(self::columns())
                ->orderBy('kode_barang', 'asc')
                ->orderBy('nup', 'asc')

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
            'master_barang_pemeliharaans.id',
            'master_barang_pemeliharaans.kode_barang',
            'master_barang_pemeliharaans.nup',
            'master_barang_pemeliharaans.nama_barang',
            'master_barang_pemeliharaans.merk',
            'master_barang_pemeliharaans.nopol',
            'master_barang_pemeliharaans.kondisi',
            'master_barang_pemeliharaans.lokasi',            
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

                ->readonly(),
            Number::make('NUP')

                ->step(1)
                ->readonly(),
            Text::make('Nama Barang')

                ->readonly(),
            Text::make('Merk')
                ->showWhenPeeking()
                ->readonly(),
            Text::make('Nopol')
                ->showWhenPeeking()
                ->readonly(),
            Select::make('Kondisi')
                ->options([
                    'Baik' => 'Baik',
                    'Rusak Ringan' => 'Rusak Ringan',
                ])
                ->displayUsingLabels()
                ->searchable()
                ->filterable()
                ->readonly(),
            Text::make('Lokasi')

                ->readonly(),
            BelongsTo::make('Pemegang', 'user', 'App\Nova\User')

                ->searchable()
                ->withSubtitles(),
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
            GreeterCard::make()
                ->user('Bobot: 60%')
                ->message(text: 'Skor Kinerja')
                ->avatar(url: Storage::disk('images')->url('trophy.svg'))
                ->verified(text: 'Dihitung dari Nilai SKP Bulanan')
                ->width('1/3'),
            GreeterCard::make()
                ->user('Bobot: 20%')
                ->message(text: 'Skor Kedisiplinan')
                ->avatar(url: Storage::disk('images')->url('clock.svg'))
                ->verified(text: 'Dihitung dari ketepatan waktu melakukan presensi')
                ->width('1/3'),
            GreeterCard::make()
                ->user('Bobot: 20%')
                ->message(text: 'Skor Beban Kerja')
                ->avatar(url: Storage::disk('images')->url('beban.svg'))
                ->verified(text: 'Dihitung dari butir jumlah SKP bulanan')
                ->width('1/3'),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('kasubbag,bmn')) {
            $actions[] =
            Download::make('karken_pemeliharaan', 'Unduh Kartu Kendali Pemeliharaan')
                ->showInline()
                ->showOnDetail()
                ->withTanggal()
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
