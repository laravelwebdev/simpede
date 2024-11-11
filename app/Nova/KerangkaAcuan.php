<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\Dipa;
use App\Models\UnitKerja;
use App\Nova\Actions\Download;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Query\Search\SearchableText;
use ShuvroRoy\NovaTabs\Tabs;
use ShuvroRoy\NovaTabs\Traits\HasTabs;

class KerangkaAcuan extends Resource
{
    use HasTabs;

    public static $with = ['unitKerja','naskahKeluar', 'arsipDokumen', 'anggaranKerangkaAcuan', 'spesifikasiKerangkaAcuan'];

    public static function label()
    {
        return 'Kerangka Acuan Kerja';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal', session('year'));
        if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            return $query->where('unit_kerja_id', Helper::getDataPegawaiByUserId($request->user()->id, now())->unit_kerja_id);
        }

        return $query;
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

    public function subtitle()
    {
        return $this->rincian;
    }

    /**
     * Get the searchable columns for the resource.
     *
     * @return array
     */
    public static function searchableColumns()
    {
        return ['tanggal', new SearchableText('rincian'), 'status'];
    }

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
            BelongsTo::make('Unit Kerja')
                ->filterable(),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat'])
                ->failedWhen(['outdated']),
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
            new Panel('Penanda Tangan', $this->pengelolaFields()),
            new Panel('DIPA', [
                Select::make('DIPA Tahun Anggaran:', 'dipa_id')
                    ->searchable()
                    ->rules('required')
                    ->displayUsingLabels()
                    ->options(Helper::setOptionDipa())
                    ->default(Helper::getPropertyFromCollection(Dipa::cache()->get('all')->where('tahun', session('year'))->first(), 'id')),
            ]),
            Tabs::make('Detail', [
                HasMany::make('Anggaran', 'anggaranKerangkaAcuan', 'App\Nova\AnggaranKerangkaAcuan'),
                HasMany::make('Spesifikasi', 'spesifikasiKerangkaAcuan', 'App\Nova\SpesifikasiKerangkaAcuan'),
                HasMany::make('Arsip Dokumen', 'arsipDokumen', 'App\Nova\ArsipDokumen'),
            ]),
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

    public function replicate()
    {
        return tap(parent::replicate(), function ($resource) {
            $model = $resource->model();
            $model->tanggal = null;
            $model->awal = null;
            $model->akhir = null;
        });
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
                    if (Helper::getYearFromDateString($value) != session('year')) {
                        return $fail('Tanggal harus di tahun yang telah dipilih');
                    }
                })
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            BelongsTo::make('Nomor', 'naskahKeluar', 'App\Nova\naskahKeluar')
                ->onlyOnDetail(),
            Text::make('Rincian', 'rincian')
                ->rules('required')
                ->help('Contoh : Pembayaran Honor......    Pembayaran Biaya Perjalanan Dinas dalam rangka...      Pengadaan Perlengkapan....'),
            Textarea::make('Latar Belakang', 'latar')
                ->rules('required')
                ->alwaysShow()
                ->help('Contoh : Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.'),
            Textarea::make('Maksud', 'maksud')
                ->rules('required')
                ->alwaysShow()
                ->help('Contoh: Maksud dari pelaksanaan kegiatan ini adalah untuk menyediakan ATK Pelatihan Petugas PLKUMKM.')
                ->default('Maksud dari pelaksanaan kegiatan ini adalah untuk '),
            Textarea::make('Tujuan', 'tujuan')
                ->rules('required')
                ->alwaysShow()
                ->help('Contoh: Tujuan dari pelaksanaan kegiatan ini adalah tersedianya ATK Pelatihan Petugas PLKUMKM tepat waktu. Dengan ini diharapkan pelaksanaan PLKUMKM  dapat berjalan dengan lancar dan efektif.')
                ->default('Tujuan dari pelaksanaan kegiatan ini adalah '),
            Textarea::make('Target/Sasaran', 'sasaran')
                ->help('Contoh: Target/sasaran yang ingin dicapai terkait dengan pelaksanaan kegiatan ini adalah Kegiatan PLKUMKM dapat berjalan dengan lancar.')
                ->rules('required')
                ->alwaysShow()
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
                ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                ->dependsOn('tanggal', function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('koordinator', Helper::createDateFromString($formData->tanggal)));
                }),
            Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                ->rules('required')
                ->searchable()
                ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                ->dependsOn('tanggal', function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal)));
                }),

        ];
    }
}
