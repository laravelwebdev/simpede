<?php

namespace App\Nova;

use App\Helpers\Helper;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Comodolab\Nova\Fields\Help\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use OwenMelbz\RadioField\RadioButton;

class Permintaan extends Resource
{
    use Breadcrumbs;
    public static $trafficCop = false;

    public static $group = 'Perekaman';

    public static function label()
    {
        return 'Daftar Permintaan';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Permintaan::class;

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
        'nomor', 'tanggal', 'rincian',
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (Auth::user()->role == 'koordinator') {
            return $query->where('unit', '=', Auth::user()->unit);
        }
    }

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
            new Panel('Keterangan Umum', $this->utamaFields()),
            new Panel('Keterangan Pagu', $this->anggaranFields()),
            new Panel('Detail Permintaan', $this->keteranganFields()),
            new Panel('Pengiriman ke PPK', $this->kirimppkFields()),
            new Panel('Pengiriman ke PPSPM', $this->kirimppspmFields()),
            new Panel('Keterangan Pengadaan', $this->pengadaanFields()),
            new Panel('Kelengkapan Pembayaran dan Pengarsipan', $this->umumFields()),
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
    //         Help::warning('Perhatian!', 'Pastikan Tanggal Permintaan sebelum kegiatan dilaksanakan. Tanggal Permintaan tidak dapat diubah lagi'),
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
            Stack::make('Nomor/Tanggal', [
                Line::make('Nomor', 'nomor')->asHeading(),
                Date::make('Tanggal Permintaan', 'tanggal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            ]),
            Textarea::make('Rincian')
                ->showOnIndex()
                ->readMore(['max' => 255, 'mask' => '(...)']),
            Text::make('Unit Kerja', 'unit'),
            Link::make('Unduh', 'link')->text('Unduh'),
        ];
    }

    /**
     * Get the fields displayed by the resource on index page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fieldsForUpdate(Request $request)
    {
        switch (Auth::user()->role) {
            case 'koordinator':
                return [
                    // ID::make(__('ID'), 'id')->sortable(),
                    new Panel('Keterangan Umum', $this->utamaFields()),
                    new Panel('Keterangan Pagu', $this->anggaranFields()),
                    new Panel('Detail Permintaan', $this->keteranganFields()),
                ];
                break;
            case 'ppk':
                return [
                    // ID::make(__('ID'), 'id')->sortable(),
                    new Panel('Keterangan Umum', $this->utamaFields()),
                    new Panel('Keterangan Pagu', $this->anggaranFields()),
                    new Panel('Detail Permintaan', $this->keteranganFields()),
                    new Panel('Pengiriman ke PPK', $this->kirimppkFields()),
                    new Panel('Keterangan Pengadaan', $this->pengadaanFields()),
                ];
                break;
            case 'ppspm':
                return [
                    // ID::make(__('ID'), 'id')->sortable(),
                    new Panel('Keterangan Umum', $this->utamaNonFields()),
                    new Panel('Keterangan Pagu', $this->anggaranFields()),
                    new Panel('Detail Permintaan', $this->keteranganNonFields()),
                    new Panel('Pengiriman ke PPSPM', $this->kirimppspmFields()),
                ];
                break;
                case 'bendahara':
                    return [
                        // ID::make(__('ID'), 'id')->sortable(),
                        new Panel('Keterangan Umum', $this->utamaNonFields()),
                        new Panel('Keterangan Pagu', $this->anggaranFields()),
                        new Panel('Detail Permintaan', $this->keteranganNonFields()),
                        new Panel('Kelengkapan Pembayaran dan Pengarsipan', $this->umumFields()),
                    ];
                    break;
            default:
            return [
                // ID::make(__('ID'), 'id')->sortable(),
                new Panel('Keterangan Umum', $this->utamaNonFields()),
                new Panel('Keterangan Pagu', $this->anggaranFields()),
                new Panel('Detail Permintaan', $this->keteranganNonFields()),
                new Panel('Pengiriman ke PPK', $this->kirimppkFields()),
                new Panel('Pengiriman ke PPSPM', $this->kirimppspmFields()),
                new Panel('Keterangan Pengadaan', $this->pengadaanFields()),
                new Panel('Kelengkapan Pembayaran dan Pengarsipan', $this->umumFields()),
            ];
            }
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
                ->hideWhenCreating()
                ->readonly()->sortable()
                ->rules('required'),
            Date::make('Tanggal Permintaan', 'tanggal')
                ->readonly()->sortable()
                ->rules('required', 'before:tomorrow')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Help::info('Contoh rincian permintaan:', 'Pembayaran Honor......    Pembayaran Biaya Perjalanan Dinas dalam rangka...      Pengadaan Perlengkapan....'),
            Textarea::make('Rincian Permintaan', 'rincian')
                ->rules('required')->alwaysShow(),
        ];
    }

    /**
     * Fields Utama Non koor dan PPK.
     *
     *
     * @return array
     */
    public function utamaNonFields()
    {
        return [
            Text::make('Nomor', 'nomor')
                ->readonly(),
            Date::make('Tanggal Permintaan', 'tanggal')
                ->readonly()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Text::make('Rincian Permintaan', 'rincian')
                ->readonly(),
        ];
    }

    // /**
    //  * Fields anggaran.
    //  *
    //  *
    //  * @return array
    //  */
    // public function anggaranFields()
    // {
    //     return [
    //         DynamicSelect::make('MAK', 'mak')
    //             ->options(
    //                 DB::table('poks')->select('mak')->pluck('mak', 'mak')
    //             )
    //             ->rules('required'),
    //         DynamicSelect::make('Detail', 'detail')
    //             ->dependsOn(['mak'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select(['id', 'detail'])
    //                 ->where('mak', $values['mak'])
    //                 ->pluck('detail', 'id');
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Program', 'program')
    //         ->dependsOn(['detail'])
    //         ->options(function ($values) {
    //             return DB::table('poks')->select('program')
    //             ->where('id', $values['detail'])
    //             ->pluck('program', 'program');
    //         })
    //         ->default(function ($values) {
    //             if (! $values) {
    //                 return null;
    //             } else {
    //                 $program = DB::table('poks')->select('program')
    //                 ->where('id', $values['detail'])
    //                 ->value('program');

    //                 return [
    //                     'label' => $program,
    //                     'value' => $program,
    //                 ];
    //             }
    //         })
    //         ->rules('required'),
    //         DynamicSelect::make('Kegiatan', 'kegiatan')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('kegiatan')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('kegiatan', 'kegiatan');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $kegiatan = DB::table('poks')->select('kegiatan')
    //                     ->where('id', $values['detail'])
    //                     ->value('kegiatan');

    //                     return [
    //                         'label' => $kegiatan,
    //                         'value' => $kegiatan,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('KRO', 'kro')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('kro')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('kro', 'kro');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $kro = DB::table('poks')->select('kro')
    //                     ->where('id', $values['detail'])
    //                     ->value('kro');

    //                     return [
    //                         'label' => $kro,
    //                         'value' => $kro,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('RO', 'ro')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('ro')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('ro', 'ro');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $ro = DB::table('poks')->select('ro')
    //                     ->where('id', $values['detail'])
    //                     ->value('ro');

    //                     return [
    //                         'label' => $ro,
    //                         'value' => $ro,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Komponen', 'komponen')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('komponen')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('komponen', 'komponen');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $komponen = DB::table('poks')->select('komponen')
    //                     ->where('id', $values['detail'])
    //                     ->value('komponen');

    //                     return [
    //                         'label' => $komponen,
    //                         'value' => $komponen,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Sub Komponen', 'sub')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('sub')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('sub', 'sub');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $sub = DB::table('poks')->select('sub')
    //                     ->where('id', $values['detail'])
    //                     ->value('sub');

    //                     return [
    //                         'label' => $sub,
    //                         'value' => $sub,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Akun', 'akun')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('akun')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('akun', 'akun');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $akun = DB::table('poks')->select('akun')
    //                     ->where('id', $values['detail'])
    //                     ->value('akun');

    //                     return [
    //                         'label' => $akun,
    //                         'value' => $akun,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Volume', 'volume')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('volume')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('volume', 'volume');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $volume = DB::table('poks')->select('volume')
    //                     ->where('id', $values['detail'])
    //                     ->value('volume');

    //                     return [
    //                         'label' => $volume,
    //                         'value' => $volume,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Harga Satuan', 'harga')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('harga')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('harga', 'harga');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $harga = DB::table('poks')->select('harga')
    //                     ->where('id', $values['detail'])
    //                     ->value('harga');

    //                     return [
    //                         'label' => $harga,
    //                         'value' => $harga,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Total Pagu', 'jumlah')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('jumlah')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('jumlah', 'jumlah');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $jumlah = DB::table('poks')->select('jumlah')
    //                     ->where('id', $values['detail'])
    //                     ->value('jumlah');

    //                     return [
    //                         'label' => $jumlah,
    //                         'value' => $jumlah,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Realisasi', 'realisasi')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('realisasi')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('realisasi', 'realisasi');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $realisasi = DB::table('poks')->select('realisasi')
    //                     ->where('id', $values['detail'])
    //                     ->value('realisasi');

    //                     return [
    //                         'label' => $realisasi,
    //                         'value' => $realisasi,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //         DynamicSelect::make('Sisa Pagu', 'sisa')
    //             ->dependsOn(['detail'])
    //             ->options(function ($values) {
    //                 return DB::table('poks')->select('sisa')
    //                 ->where('id', $values['detail'])
    //                 ->pluck('sisa', 'sisa');
    //             })->default(function ($values) {
    //                 if (! $values) {
    //                     return null;
    //                 } else {
    //                     $sisa = DB::table('poks')->select('sisa')
    //                     ->where('id', $values['detail'])
    //                     ->value('sisa');

    //                     return [
    //                         'label' => $sisa,
    //                         'value' => $sisa,
    //                     ];
    //                 }
    //             })
    //             ->rules('required'),
    //     ];
    // }

    /**
     * Fields anggaran non PPk dan KKor.
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
            Text::make('Volume', 'volume')
                ->readonly(),
            Currency::make('Harga Satuan', 'harga')
                ->readonly()
                ->locale('id'),
            Currency::make('Total Pagu', 'jumlah')
                ->readonly()
                ->locale('id'),
            Currency::make('Realisasi', 'realisasi')
                ->locale('id')
                ->readonly(),
            Currency::make('Sisa Pagu', 'sisa')
                ->readonly()
                ->locale('id'),
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
            Help::info('Contoh item permintaan:', 'Honor......    Biaya Perjalanan Dinas.     Perlengkapan petugas pelatihan....'),
            Text::make('Item Permintaan', 'item')
                ->rules('required'),
            Textarea::make('Tambahan Rincian di KAK', 'tambahan_kak')->placeholder('Tambahan keterangan misalnya alasan kenapa pelatihan harus di luar kota dsb. Kosongkan jika tidak ada'),
            Currency::make('Perkiraan Digunakan', 'perkiraan')
                ->currency('IDR')
                ->locale('id')
                ->rules('required'),
            Help::info('Spesifikasi Biaya Perjalanan Dinas Biasa:', '<ul><li>Uang harian Rp. 380.000/ hari </li><li>Transport Banjarbaru Rp. 280.000</li>  <li>Penginapan es IV ke bawah maksimal Rp 648.000/malam</li></ul>')->displayAsHtml(),
            Help::danger('Isikan spesifikasi secara detil dan spesifik'),
            SimpleRepeatable::make('Spesifikasi', 'spesifikasi', [
                Text::make('Rincian', 'spek_rincian')->placeholder('kertas A4')->rules('required'),
                Number::make('Jumlah', 'spek_vol')->rules('required'),
                Text::make('Satuan', 'spek_sat')->rules('required'),
                Currency::make('Harga Satuan', 'spek_satuan')->rules('required'),
                // Currency::make('Nilai', 'spek_nilai')->rules('required'),
                Textarea::make('Spesifikasi', 'spek_spek')->rows(2)->rules('required')->placeholder('Mohon diisi secara detail dan spesifik')->alwaysShow(),
            ])->rules('required'),
            // Text::make('Lama Pelaksanaan', 'waktu')
            //     ->placeholder('1 (satu) bulan , 5 (lima) hari')
            //     ->rules('required'),
            Date::make('Awal', 'awal')
                ->rules('required', 'after_or_equal:tanggal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Date::make('Akhir', 'akhir')
                ->rules('required', 'after_or_equal:awal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Text::make('Nama Survei/Kegiatan', 'survei')
                ->placeholder('Contoh: Survei Sosial Ekonomi Nasional , Administrasi Kepegawaian')
                ->rules('required'),
        ];
    }

    /**
     * Fields Detail Non PPK dan Koor.
     *
     *
     * @return array
     */
    public function keteranganNonFields()
    {
        return [
            Text::make('Item Permintaan', 'item')->readonly(),
            Currency::make('Perkiraan Digunakan', 'perkiraan')
                ->currency('IDR')
                ->locale('id')
                ->readonly(),
            SimpleRepeatable::make('Spesifikasi', 'spesifikasi', [
                Text::make('Rincian', 'spek_rincian'),
                Text::make('Jumlah', 'spek_vol'),
                Currency::make('Harga Satuan', 'spek_satuan'),
                Currency::make('Nilai', 'spek_nilai'),
                Textarea::make('Spesifikasi', 'spek_spek')->alwaysShow(),
            ])->readonly(),
            Text::make('Lama Pelaksanaan', 'waktu')
                ->readonly(),
            Date::make('Awal', 'awal')
                ->readonly()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Date::make('Akhir', 'akhir')
                ->readonly()->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Text::make('Nama Survei/Kegiatan', 'survei')
                ->readonly(),
        ];
    }

    /**
     * Fields Pengadaan.
     *
     *
     * @return array
     */
    public function pengadaanFields()
    {
        return [
            RadioButton::make('Tipe Pengelolaan', 'jenis')
                ->options(Helper::$pengelolaan)
                ->toggle([
                    'swakelola' => ['hps', 'penyedia', 'no_spk', 'tgl_spk', 'no_bast', 'tgl_bast'],
                ])
                ->default('penyedia'),
            Help::info('HPS:', 'Untuk Pengadaan di bawah 10 juta diisi dengan jumlah perkiraan digunakan'),
            Currency::make('HPS', 'hps')
                ->currency('IDR')
                ->locale('id'),
            Select::make('Nama Penyedia', 'penyedia')
                ->options(DB::table('penyedias')->select(['penyedia', 'id'])
                ->pluck('penyedia', 'id'))->displayUsing(function ($penyedia) {
                    if ($penyedia) {
                        return DB::table('penyedias')->where('id', '=', $penyedia)->first('penyedia')->penyedia;
                    }
                }),
            Text::make('Nomor SPK/Permintaan', 'no_spk'),
            Date::make('Tanggal SPK/Surat Permintaan', 'tgl_spk')->displayUsing(function ($tanggal) {
                return Helper::terbilangTanggal($tanggal);
            }),
            Text::make('Nomor BAST', 'no_bast'),
            Date::make('Tanggal BAST', 'tgl_bast')->displayUsing(function ($tanggal) {
                return Helper::terbilangTanggal($tanggal);
            }),
        ];
    }

    /**
     * Fields Detail.
     *
     *
     * @return array
     */
    public function kirimppkFields()
    {
        return [
            Date::make('Tanggal Diterima PPK', 'terimappk')
                ->rules('required', 'after_or_equal:akhir')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Currency::make('Jumlah dibayarkan', 'jumlah_bayar')
                ->currency('IDR')
                ->locale('id')
                ->rules('required'),
            RadioButton::make('Surat Permintaan', 'permintaan')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('KAK', 'kak')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('SK', 'sk')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Surat Tugas', 'st')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('SPJ/Nota/Berkas Pengadaan', 'spj')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Laporan', 'laporan')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Kontrak Petugas', 'kontrak')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Kartu Kendali Organik', 'kk_organik')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Diperlukan'),
            RadioButton::make('Kartu Kendali Mitra', 'kk_mitra')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Diperlukan'),
            RadioButton::make('Undangan', 'undangan')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Daftar Hadir', 'daftar_hadir')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Notulensi', 'notulen')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Daftar Pengeluaran Riil', 'dpr')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Kuitansi SPPD', 'kuitansi_spd')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
        ];
    }

    /**
     * Fields kirim PPSPM.
     *
     *
     * @return array
     */
    public function kirimppspmFields()
    {
        return [
            RadioButton::make('Cara Pembayaran', 'carabayar')
                ->options(Helper::$carabayar)
                ->toggle([
                    'LS' => ['no_spby'],
                ])
                ->default('UP'),
            Text::make('Nomor SPBy', 'no_spby'),
            Date::make('Tanggal Diterima PPSPM', 'terimappspm')
                ->rules('required')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            RadioButton::make('SPBy', 'spby')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('SPP', 'spp')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
        ];
    }

    /**
     * Fields Bagian Umum.
     *
     *
     * @return array
     */
    public function umumFields()
    {
        return [
            Date::make('Tanggal Pembayaran', 'bayar')
                ->rules('required')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Text::make('Kelompok', 'kelompok')
                ->placeholder('GU ke .., LS')
                ->rules('required'),
            RadioButton::make('SSP PPN', 'ppn')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('SSP PPh', 'pph')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('SPM', 'spm')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('SP2D', 'sp2d')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Kuitansi Pembayaran', 'kuitansi')
                ->options(Helper::$kelengkapan)
                ->default('Tidak Ada'),
            RadioButton::make('Scan SPJ', 'scan')
                ->options(Helper::$scan)
                ->default('Belum'),
        ];
    }
}
