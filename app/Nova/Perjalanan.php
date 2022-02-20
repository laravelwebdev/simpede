<?php

namespace App\Nova;

use App\Helpers\Helper;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Comodolab\Nova\Fields\Help\Help;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;
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

class Perjalanan extends Resource
{
    use Breadcrumbs;
    public static $group = 'Perekaman';

    public static function label()
    {
        return 'Perjalanan';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Perjalanan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nomor';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'no_permintaan', 'tujuan_spd', 'nomor',
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
            new Panel('Keterangan Pagu', $this->anggaranFields()),
            new Panel('Detail SPPD', $this->keteranganFields()),
            new Panel('Pelaksana SPPD', $this->pelaksanaFields()),
            new Panel('Rincian Penggantian Biaya', $this->biayaFields()),
        ];
    }

    // /**
    //  * Get the fields displayed by the resource on create page.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return array
    //  */
    // public function fieldsForCreate(Request $request)
    // {
    //     return [
    //         // ID::make(__('ID'), 'id')->sortable(),
    //         new Panel('Permintaan', $this->permintaanFields()),
    //         new Panel('Keterangan Umum', $this->utamaFields()),
    //     ];
    // }

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
                Line::make('Nomor', 'no_permintaan')->asHeading(),
                Date::make('Tanggal Permintaan', 'tgl_permintaan')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            ]),
            Stack::make('SPD/Tanggal', [
                Line::make('Nomor', 'nomor')->asHeading(),
                Date::make('Tanggal SPD', 'tanggal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            ]),
            Textarea::make('Tujuan', 'tujuan_spd')
                ->showOnIndex()
                ->readMore(['max' => 255, 'mask' => '(...)']),
            Link::make('Unduh SPD', 'link')->text('Unduh'),
            Link::make('Unduh DPR', 'link_dpr')->text('Unduh'),
        ];
    }

    // /**
    //  * Return the location to redirect the user after creation.
    //  *
    //  * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
    //  * @param  \Laravel\Nova\Resource  $resource
    //  * @return string
    //  */
    // public static function redirectAfterCreate(NovaRequest $request, $resource)
    // {
    //     return '/resources/'.static::uriKey().'/'.$resource->getKey().'/edit';
    // }

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
            Text::make('Nomor', 'nomor')
                ->readonly()
                ->sortable(),
            Date::make('Tanggal SPPD', 'tanggal')
                ->readonly()
                ->sortable()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Textarea::make('Tujuan SPPD', 'tujuan_spd')
                ->placeholder('Perjalanan dinas dalam rangka....')
                ->rules('required')->alwaysShow(),
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
            Text::make('MAK', 'mak')
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
            Select::make('Nomor Surat Tugas', 'no_st')
                ->options(
                    DB::table('surats')->where('jenis', 'Surat Tugas')->select(['nomor'])->selectRaw("CONCAT(nomor,' ',perihal) AS keterangan")->pluck('keterangan', 'nomor')
                )
                ->rules('required'),
            Text::make('Lama Pelaksanaan', 'waktu')
                ->readonly(),
            Date::make('Berangkat', 'berangkat')
                ->readonly()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Date::make('Kembali', 'kembali')
                ->readonly()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Text::make('Kota Asal', 'asal')
                ->placeholder('Barabai')
                ->rules('required'),
            Text::make('Kota Tujuan', 'tujuan')
                ->placeholder('Banjarbaru')
                ->rules('required'),
            Text::make('Tujuan', 'tempat_tujuan')
                ->placeholder('Kantor BPS Provinsi Kalimantan Selatan')
                ->rules('required'),
            Select::make('Kendaraan', 'angkutan')
                ->options([
                    'Angkutan Umum' => 'Angkutan Umum',
                    'Kendaraan Dinas' => 'Kendaraan Dinas',
                ])
                ->rules('required'),

        ];
    }

    /**
     * Fields pelaksana.
     *
     *
     * @return array
     */
    public function pelaksanaFields()
    {
        return [
            DynamicSelect::make('Nama', 'nama')
                ->options(
                    DB::table('pegawais')->select(['id', 'nama'])->pluck('nama', 'id')
                )
                ->rules('required'),
            DynamicSelect::make('NIP', 'nip')
                ->dependsOn(['nama'])
                ->options(function ($values) {
                    return DB::table('pegawais')->select('nip')
                    ->where('id', $values['nama'])
                    ->pluck('nip', 'nip');
                })->default(function ($values) {
                    if (! $values) {
                        return null;
                    } else {
                        $nip = DB::table('pegawais')->select('nip')
                        ->where('id', $values['nama'])
                        ->value('nip');

                        return [
                            'label' => $nip,
                            'value' => $nip,
                        ];
                    }
                })
                ->rules('required'),
            DynamicSelect::make('Golongan', 'golongan')
                ->dependsOn(['nama'])
                ->options(function ($values) {
                    return DB::table('pegawais')->select('golongan')
                    ->where('id', $values['nama'])
                    ->pluck('golongan', 'golongan');
                })->default(function ($values) {
                    if (! $values) {
                        return null;
                    } else {
                        $golongan = DB::table('pegawais')->select('golongan')
                        ->where('id', $values['nama'])
                        ->value('golongan');

                        return [
                            'label' => $golongan,
                            'value' => $golongan,
                        ];
                    }
                })
                ->rules('required'),
            DynamicSelect::make('Pangkat', 'pangkat')
                ->dependsOn(['nama'])
                ->options(function ($values) {
                    return DB::table('pegawais')->select('pangkat')
                    ->where('id', $values['nama'])
                    ->pluck('pangkat', 'pangkat');
                })->default(function ($values) {
                    if (! $values) {
                        return null;
                    } else {
                        $pangkat = DB::table('pegawais')->select('pangkat')
                        ->where('id', $values['nama'])
                        ->value('pangkat');

                        return [
                            'label' => $pangkat,
                            'value' => $pangkat,
                        ];
                    }
                })
                ->rules('required'),
            DynamicSelect::make('Jabatan', 'jabatan')
                ->dependsOn(['nama'])
                ->options(function ($values) {
                    return DB::table('pegawais')->select('jabatan')
                    ->where('id', $values['nama'])
                    ->pluck('jabatan', 'jabatan');
                })->default(function ($values) {
                    if (! $values) {
                        return null;
                    } else {
                        $jabatan = DB::table('pegawais')->select('jabatan')
                        ->where('id', $values['nama'])
                        ->value('jabatan');

                        return [
                            'label' => $jabatan,
                            'value' => $jabatan,
                        ];
                    }
                })
                ->rules('required'),
        ];
    }

    /**
     * Fields biaya.
     *
     *
     * @return array
     */
    public function biayaFields()
    {
        return [
            Help::info('Spesifikasi Biaya Perjalanan Dinas Biasa:', '<ul><li>Uang harian Rp. 380.000/ hari </li><li>Transport Banjarbaru Rp. 280.000</li>  <li>Penginapan es IV ke bawah maksimal Rp 648.000/malam</li></ul>')->displayAsHtml(),
            SimpleRepeatable::make('Rincian Biaya', 'biaya', [
                Text::make('Rincian', 'spek_rincian')->placeholder('Uang Harian, Transport, hotel')->rules('required'),
                Number::make('Jumlah', 'spek_vol')->rules('required'),
                Text::make('Satuan', 'spek_sat')->placeholder('1 rim')->rules('required'),
                Currency::make('Harga Satuan', 'spek_satuan')->rules('required'),
                // Currency::make('Nilai', 'spek_nilai')->rules('required'),
                Select::make('Masuk DPR', 'spek_spek')
                ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak'])
                ->default('Ya'),
            ]),
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
            Text::make('Nomor Surat Permintaan', 'no_permintaan')
                ->readonly()->sortable(),
            Date::make('Tanggal Surat Permintaan', 'tgl_permintaan')
                ->readonly()->sortable()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
        ];
    }
}
