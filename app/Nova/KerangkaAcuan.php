<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\MataAnggaran;
use App\Nova\Repeater\Anggaran;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;

class KerangkaAcuan extends Resource
{
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
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            new Panel('Keterangan Umum', $this->utamaFields()),
            new Panel('Anggaran', $this->anggaranFields()),
            new Panel('Detail', $this->keteranganFields()),
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
            Date::make('Tanggal KAK', 'tanggal')
                ->sortable()
                ->rules('required', 'before_or_equal:today')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->filterable(),
            Text::make('Nomor')
                ->onlyOnDetail(),
            Text::make('Rincian Permintaan', 'rincian')
                ->rules('required')
                ->help('Contoh rincian permintaan: Pembayaran Honor......    Pembayaran Biaya Perjalanan Dinas dalam rangka...      Pengadaan Perlengkapan....'),
            Textarea::make('Latar Belakang', 'latar')
                ->rules('required')
                ->help('Contoh latar Belakang: Kegiatan PLKUMKM merupakan salah satu kegiatan yang dilakukan oleh Badan Pusat Statistik dalam rangka mendukung penyediaan Data Statistik sesuai amanat Undang-Undang no 16 Tahun 1997. Agar kegiatan tersebut dapat berjalan dengan lancar dan tepat waktu diperlukan adanya penyediaan ATK Pelatihan Petugas PLKUMKM sebagai sarana penunjang kegiatan yang dilaksanakan.'),
            Textarea::make('Maksud', 'maksud')
                ->rules('required')
                ->help('Contoh Maksud: menyediakan ATK Pelatihan Petugas PLKUMKM.'),
            Textarea::make('Tujuan', 'tujuan')
                ->rules('required')
                ->help('Contoh Tujuan: tersedianya ATK Pelatihan Petugas PLKUMKM tepat waktu. Dengan ini diharapkan pelaksanaan PLKUMKM  dapat berjalan dengan lancar dan efektif.'),
            Textarea::make('Target/Sasaran', 'sasaran')
                ->help('Contoh Target/Sasaran: Kegiatan PLKUMKM dapat berjalan dengan lancar.')
                ->rules('required'),
            Boolean::make('TKDN', 'tkdn')
                ->trueValue('Ya')
                ->falseValue('Tidak')
                ->rules('required'),
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
            SimpleRepeatable::make('Anggaran', 'anggaran', [
                Select::make('MAK', 'mak')
                    ->rules('required')
                    ->searchable()
                    ->displayUsingLabels()->filterable()
                    ->options(Helper::setOptions(MataAnggaran::cache()->get('all')->where('tahun', session('year')), 'id', 'mak')),
                Currency::make('Perkiraan Digunakan ', 'perkiraan')->rules('required'),
            ]),
        ];
    }

    /**
     * Fields Detail Kerangka Acuan.
     *
     *
     * @return array
     */
    public function keteranganFields()
    {
        return [
            SimpleRepeatable::make('Spesifikasi', 'spesifikasi', [
                Text::make('Rincian', 'spek_rincian')->rules('required'),
                Number::make('Jumlah', 'spek_volume')->rules('required'),
                Text::make('Satuan', 'spek_satuan')->rules('required'),
                Currency::make('Harga Satuan', 'spek_harga')->rules('required')->step(1),
                Textarea::make('Spesifikasi', 'spek_spek')->rows(2)->rules('required')->placeholder('Mohon diisi secara detail dan spesifik')->alwaysShow(),
            ]),
            Date::make('Awal', 'awal')
                ->rules('required', 'after_or_equal:tanggal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),

            Date::make('Akhir', 'akhir')
                ->rules('required', 'after_or_equal:awal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                })->help('Untuk Honor Mitra, Tanggal akhir ini akan menjadi batas waktu penyelesaian pekerjaan di bulan kontrak berjalan. Misal Kontrak Kegiatan Sakernas di bulan Agustus dan pencacahan harus selesai tanggal 20 Agustus, maka isikan 20 Agustus sebagai tanggal akhir.'),
            Text::make('Nama Survei/Kegiatan', 'kegiatan')
                ->rules('required')->help('Untuk Honor Mitra, Agar diisikan nama kegiatan secara lengkap termasuk keterangan tentang pendataan/pemeriksaan/pengolahan karena akan ditampilkan di dalam kontrak bulanan. Contoh:Pendataan Lapangan Survei Sosial Ekonomi Nasional Maret 2024, Pemeriksaan Lapangan Sakernas Agustus 2023'),
        ];
    }
}
