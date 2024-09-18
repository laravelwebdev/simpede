<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\UnitKerja;
use App\Nova\Actions\Download;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;

class KerangkaAcuan extends Resource
{
    public static $with = ['naskahKeluar', 'arsipDokumen'];

    public static function label()
    {
        return 'Kerangka Acuan Kerja';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KerangkaAcuan>
     */
    public static $model = \App\Models\KerangkaAcuan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->naskahKeluar->nomor;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'tanggal', 'rincian',
    ];

    /**
     * Get the fields displayed by the resource on index page.
     *
     * @return array
     */
    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            // ID::make(__('ID'), 'id')->sortable(),
            Stack::make('Nomor/Tanggal', 'tanggal', [
                BelongsTo::make('Nomor', 'naskahKeluar', 'App\Nova\naskahKeluar'),
                Date::make('Tanggal KAK', 'tanggal')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Rincian'),
            Text::make('Kegiatan'),
            Select::make('Unit Kerja', 'unit_kerja_id')
                ->options(Helper::setOptions(UnitKerja::cache()->get('all'), 'id', 'unit'))
                ->displayUsingLabels()
                ->filterable(),
        ];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            new Panel('Keterangan Umum', $this->utamaFields()),
            new Panel('Keterangan Pengadaan', $this->pengadaanFields()),
            new Panel('Keterangan Pejabat', $this->pengelolaFields()),
            new Panel('Anggaran', $this->anggaranFields()),
            new Panel('Spesifikasi', $this->spesifikasiFields()),
            HasMany::make('Arsip Dokumen', 'arsipDokumen', 'App\Nova\ArsipDokumen'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
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
        if (Policy::make()->allowedFor('all')->get()) {
            $actions[] =
            Download::make('kak', 'Unduh KAK')
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Unduh')
                ->exceptOnIndex();
        }

        return $actions;
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
            Date::make('Tanggal KAK', 'tanggal')
                ->sortable()
                ->rules('required', 'before_or_equal:today', function ($attribute, $value, $fail) {
                    if (Helper::getYearFromDate($value, false) != session('year')) {
                        return $fail('Tanggal harus di tahun yang telah dipilih');
                    }
                })
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->filterable(),
            BelongsTo::make('Nomor', 'naskahKeluar', 'App\Nova\naskahKeluar')
                ->onlyOnDetail(),
            Text::make('Rincian', 'rincian')
                ->rules('required')
                ->help('Contoh : Pembayaran Honor......    Pembayaran Biaya Perjalanan Dinas dalam rangka...      Pengadaan Perlengkapan....'),
            Textarea::make('Latar Belakang', 'latar')
                ->rules('required')
                ->help('Contoh : Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.'),
            Textarea::make('Maksud', 'maksud')
                ->rules('required')
                ->help('Contoh: Maksud dari pelaksanaan kegiatan ini adalah untuk menyediakan ATK Pelatihan Petugas PLKUMKM.')
                ->default('Maksud dari pelaksanaan kegiatan ini adalah untuk '),
            Textarea::make('Tujuan', 'tujuan')
                ->rules('required')
                ->help('Contoh: Tujuan dari pelaksanaan kegiatan ini adalah tersedianya ATK Pelatihan Petugas PLKUMKM tepat waktu. Dengan ini diharapkan pelaksanaan PLKUMKM  dapat berjalan dengan lancar dan efektif.')
                ->default('Tujuan dari pelaksanaan kegiatan ini adalah '),
            Textarea::make('Target/Sasaran', 'sasaran')
                ->help('Contoh: Target/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah Kegiatan PLKUMKM dapat berjalan dengan lancar.')
                ->rules('required')
                ->default('Target/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah '),
            Text::make('Nama Survei/Kegiatan', 'kegiatan')
                ->rules('required')->help('Untuk Honor Mitra, Agar diisikan nama kegiatan secara lengkap termasuk keterangan tentang pendataan/pemeriksaan/pengolahan karena akan ditampilkan di dalam kontrak bulanan. Contoh:Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024, Pemeriksaan Lapangan Sakernas Agustus 2023'),
            Date::make('Awal', 'awal')
                ->rules('required', 'after_or_equal:tanggal')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->help('Tanggal pelaksanaan kegiatan dimulai'),

            Date::make('Akhir', 'akhir')
                ->rules('required', 'after_or_equal:awal')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->help('Batas akhir pelaksanaan kegiatan'),

        ];
    }

    /**
     * Fields Anggaran.
     *
     *
     * @return array
     */
    public function anggaranFields()
    {
        return [
            HasMany::make('Anggaran', 'anggaranKerangkaAcuan', 'App\Nova\AnggaranKerangkaAcuan'),
            // SimpleRepeatable::make('Anggaran', 'anggaran', [
            //     Select::make('MAK', 'mak')
            //         ->rules('required')
            //         ->searchable()
            //         ->filterable()
            //         ->dependsOn('tanggal', function (Select $field, NovaRequest $request, FormData $formData) {
            //             $field->options(Helper::setOptionsMataAnggaran(Helper::getYearFromDate($formData->tanggal)));
            //         }),

            //     Currency::make('Perkiraan Digunakan ', 'perkiraan')
            //         ->rules('required')
            //         ->step(1)
            //         ->default(0),
            // ])->rules('required', function ($attribute, $value, $fail) {
            //     if (Helper::cekGanda(json_decode($value), 'mak')) {
            //         return $fail('validation.unique')->translate();
            //     }
            // }, function ($attribute, $value, $fail) {
            //     if ($value == '[]') {
            //         return $fail('validation.required')->translate();
            //     }
            // },
            //     function ($attribute, $value, $fail) {
            //         if (Helper::sumJenisAkunHonor(json_decode($value, true)) > 1) {
            //             return $fail('Untuk kemudahan penyusunan SPJ, satu KAK hanya boleh memuat satu akun honor output kegiatan');
            //         }
            //     },
            //     function ($attribute, $value, $fail) {
            //         if (Helper::sumJenisAkunPerjalanan(json_decode($value, true)) > 1) {
            //             return $fail('Untuk kemudahan penyusunan SPJ, satu KAK hanya boleh memuat satu akun perjalanan dinas');
            //         }
            //     },
            //     function ($attribute, $value, $fail) {
            //         if (Helper::sumJenisAkunPersediaan(json_decode($value, true)) > 1) {
            //             return $fail('Untuk kemudahan penyusunan SPJ, satu KAK hanya boleh memuat satu akun persediaan');
            //         }
            //     },
            // ),
        ];
    }

    /**
     * Fields Spesifikasi Kerangka Acuan.
     *
     *
     * @return array
     */
    public function spesifikasiFields()
    {
        return [
            HasMany::make('Spesifikasi', 'spesifikasiKerangkaAcuan', 'App\Nova\SpesifikasiKerangkaAcuan'),
            // SimpleRepeatable::make('Spesifikasi', 'spesifikasi', [
            //     Text::make('Rincian', 'spek_rincian')
            //         ->rules('required'),
            //     Number::make('Jumlah', 'spek_volume')
            //         ->rules('required')
            //         ->default(0),
            //     Text::make('Satuan', 'spek_satuan')
            //         ->rules('required'),
            //     Currency::make('Harga Satuan', 'spek_harga')
            //         ->rules('required')
            //         ->step(1)
            //         ->default(0),
            //     Textarea::make('Spesifikasi', 'spek_spek')
            //         ->rows(2)
            //         ->rules('required')
            //         ->placeholder('Mohon diisi secara detail dan spesifik')
            //         ->alwaysShow(),
            // ])->rules('required', function ($attribute, $value, $fail) {
            //     if ($value == '[]') {
            //         return $fail('validation.required')->translate();
            //     }
            // })->stacked(),
        ];
    }

    /**
     * Fields Pengadaan Kerangka Acuan.
     *
     *
     * @return array
     */
    public function pengadaanFields()
    {
        return [
            Select::make('Identifikasi Pemaketan', 'jenis')
                ->help('Non Pengadaan Contohnya:Gaji, Honor Non Mitra, Biaya Perjalanan Dinas, Transport Lokal')
                ->options([
                    'Swakelola' => 'Swakelola',
                    'Penyedia' => 'Penyedia',
                    'Non Pengadaan' => 'Non Pengadaan
                ', ])
                ->rules('required'),
            Select::make('Metode Pengadaan', 'metode')
                ->options([
                    'Pengadaan Langsung' => 'Pengadaan Langsung',
                    'Penunjukan Langsung' => 'Penunjukan Langsung',
                    'Seleksi' => 'Seleksi',
                    'Tender' => 'Tender',
                    'Tender Cepat' => 'Tender Cepat',
                    'E-Purchasing' => 'E-Purchasing',
                ])
                ->hide()
                ->dependsOn('jenis', function (Select $field, NovaRequest $request, FormData $formData) {
                    if ($formData->jenis === 'Penyedia') {
                        $field->show()->rules('required');
                    }
                }),
            Boolean::make('TKDN', 'tkdn')
                ->trueValue('Ya')
                ->falseValue('Tidak')
                ->hide()
                ->dependsOn('jenis', function (Boolean $field, NovaRequest $request, FormData $formData) {
                    if ($formData->jenis === 'Penyedia') {
                        $field->show()->rules('required');
                    }
                }),

        ];
    }

    public function pengelolaFields()
    {
        return [
            Select::make('Pembuat KAK', 'koordinator_user_id')
                ->rules('required')
                ->searchable()
                ->dependsOn('tanggal', function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('koordinator', Carbon::createFromFormat('d/m/Y', Carbon::parse($formData->tanggal))));
                }),
            Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                ->rules('required')
                ->searchable()
                ->dependsOn('tanggal', function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('ppk', Carbon::createFromFormat('d/m/Y', Carbon::parse($formData->tanggal))));
                }),

        ];
    }

    /**
     * Handle any post-validation processing.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    protected static function afterValidation(NovaRequest $request, $validator)
    {
        $spesifikasi = Helper::addTotalToSpek(json_decode($request->spesifikasi, true));
        if (Helper::sumJson($spesifikasi, 'spek_nilai') != Helper::sumJson(json_decode($request->anggaran), 'perkiraan')) {
            $validator->errors()->add('spesifikasi', 'Perkiraan anggaran yang digunakan tidak sama dengan total nilai pada spesifikasi!');
        }
    }
}
