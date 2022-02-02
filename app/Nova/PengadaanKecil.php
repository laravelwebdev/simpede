<?php

namespace App\Nova;

use App\Helpers\Helper;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Comodolab\Nova\Fields\Help\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khalin\Nova\Field\Link;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSimpleRepeatable\SimpleRepeatable;

class PengadaanKecil extends Resource
{
    use Breadcrumbs;
    public static $group = 'Perekaman';

    public static function label()
    {
        return 'Pengadaan Kecil';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PengadaanKecil::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kode';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'rincian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            // ID::make(__('ID'), 'id')->sortable(),
            new Panel('Permintaan', $this->permintaanFields()),
            new Panel('Keterangan Umum', $this->utamaFields()),
            new Panel('Detail Pengadaan', $this->keteranganFields()),
            new Panel('Keterangan Pagu', $this->anggaranFields()),
            new Panel('Keterangan Penyedia', $this->penyediaFields()),
        ];
    }

    /**
     * Get the fields displayed by the resource on index page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fieldsForIndex(Request $request)
    {
        return [
            // ID::make(__('ID'), 'id')->sortable(),
            Stack::make('Permintaan/Tanggal', [
                Line::make('Nomor', 'nomor')->asHeading(),
                Date::make('Tanggal Permintaan', 'tanggal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            ]),
            Text::make('Kode'),
            Textarea::make('Tujuan SPD', 'rincian')
                ->showOnIndex()
                ->readMore(['max' => 255, 'mask' => '(...)']),
            Link::make('Unduh', 'link')->text('Unduh'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Fields Utama.
     *
     *
     * @return array
     */
    public function utamaFields()
    {
        return [
            Help::info('Kode:', 'Kode untuk surat permintaan. Contoh RAG untuk rapid antigen'),
            Text::make('Kode', 'kode')
                ->rules('required')->sortable()
                ->creationRules('unique:pengadaan_kecils,kode')
                ->updateRules('unique:pengadaan_kecils,kode,{{resourceId}}'),
            Text::make('Rincian Pengadaan', 'rincian')->sortable()
                ->placeholder('Pengadaan ......')
                ->readonly(),
        ];
    }

    /**
     * Fields Detail.
     *
     *
     * @return array
     */
    public function keteranganFields()
    {
        return [
            Date::make('Tanggal Permintaan PPK ke PBJ', 'tgl_proses')
                ->rules('required', 'after_or_equal:tanggal', 'before_or_equal:awal')->sortable()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Date::make('Tanggal SP ke Penyedia', 'tgl_sp')->sortable()
                ->rules('required', 'after_or_equal:tgl_proses', 'before_or_equal:akhir')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Text::make('Lama Pelaksanaan', 'waktu')
                ->placeholder('1 (satu) bulan , 5 (lima) hari')
                ->readonly(),
            Date::make('Awal', 'awal')
                ->readonly()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Date::make('Akhir', 'akhir')
                ->readonly()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Select::make('Cara Pengadaan', 'jenis')
                ->options(Helper::$metode)
                ->rules('required'),
            SimpleRepeatable::make('Spesifikasi', 'spesifikasi', [
                Text::make('Rincian', 'spek_rincian')->placeholder('kertas A4')->rules('required'),
                Number::make('Jumlah', 'spek_vol')->rules('required'),
                Text::make('Satuan', 'spek_sat')->rules('required'),
                Currency::make('Harga Satuan', 'spek_satuan')->rules('required'),
                // Currency::make('Nilai', 'spek_nilai')->rules('required'),
                Textarea::make('Spesifikasi', 'spek_spek')->rows(2)->rules('required')->placeholder('1.
2.')->alwaysShow(),
            ])->rules('required'),
            Currency::make('Perkiraan Nilai', 'perkiraan')
                ->currency('IDR')
                ->locale('id')
                ->readonly(),
            Currency::make('Nilai Real Pembayaran', 'jumlah_bayar')
                ->currency('IDR')
                ->locale('id')
                ->readonly(),
        ];
    }

    /**
     * Fields anggaran.
     *
     *
     * @return array
     */
    public function anggaranFields()
    {
        return [
            Text::make('Program', 'program')
                ->readonly(),
            Text::make('Kegiatan', 'kegiatan')
                ->readonly(),
            Text::make('KRO', 'kro')
                ->readonly(),
            Text::make('RO', 'ro')
                ->readonly(),
            Text::make('Komponen', 'komponen')
                ->readonly(),
            Text::make('Sub Komponen', 'sub')
                ->readonly(),
            Text::make('Akun', 'akun')
                ->readonly(),
            Text::make('MAK', 'mak')
                ->readonly(),
            Text::make('Detail', 'detail')
                ->readonly()->resolveUsing(function ($detail) {
                    return DB::table('poks')->where('id', '=', $detail)->first('detail')->detail;
                }),
        ];
    }

    /**
     * Fields Penyedia.
     *
     *
     * @return array
     */
    public function penyediaFields()
    {
        return [
            Text::make('Nama Penyedia', 'penyedia')
                ->readonly()->resolveUsing(function ($penyedia) {
                    if ($penyedia) {
                        return DB::table('penyedias')->where('id', '=', $penyedia)->first('penyedia')->penyedia;
                    }
                }),
            Text::make('Alamat Penyedia', 'alamat')
                ->readonly(),
        ];
    }

    /**
     * Fields Permintaan.
     *
     *
     * @return array
     */
    public function permintaanFields()
    {
        return [
            Text::make('Nomor Surat Permintaan', 'nomor')
                ->readonly(),
            Date::make('Tanggal Surat Permintaan', 'tanggal')
                ->readonly()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
        ];
    }
}
