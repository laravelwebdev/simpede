<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\JenisKontrak;
use App\Models\KamusAnggaran;
use App\Models\KodeArsip;
use App\Nova\Actions\Download;
use App\Nova\Actions\ImportDaftarHonorMitra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use ShuvroRoy\NovaTabs\Tabs;
use ShuvroRoy\NovaTabs\Traits\HasTabs;

class HonorKegiatan extends Resource
{
    use HasTabs;
    public static $with = ['kerangkaAcuan.naskahKeluar', 'daftarHonorMitra', 'skNaskahKeluar', 'stNaskahKeluar', 'daftarHonorPegawai'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\HonorKegiatan>
     */
    public static $model = \App\Models\HonorKegiatan::class;

    public static function label()
    {
        return 'Honor Kegiatan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kegiatan';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'judul_spj', 'bulan',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('Tanggal KAK', 'tanggal_kak'),
            Panel::make('Keterangan SPJ', [
                BelongsTo::make('Nomor KAK', 'kerangkaAcuan', 'App\Nova\KerangkaAcuan')
                    ->rules('required')
                    ->sortable()
                    ->readOnly()
                    ->hideWhenUpdating(),
                Text::make('Nama Survei', 'kegiatan')
                    ->rules('required')
                    ->sortable()
                    ->readOnly()
                    ->hideWhenUpdating(),
                Date::make('Awal Pelaksanaan', 'awal')
                    ->rules('required')
                    ->hideFromIndex()
                    ->readOnly()
                    ->hideWhenUpdating()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                Date::make('Akhir Penyelesaian', 'akhir')
                    ->rules('required')
                    ->hideFromIndex()
                    ->readOnly()
                    ->hideWhenUpdating()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                Text::make('Judul SPJ', 'judul_spj')
                    ->rules('required')
                    ->sortable()
                    ->hideFromIndex(),
                Date::make('Tanggal SPJ', 'tanggal_spj')
                    ->rules('required', 'after_or_equal:akhir')
                    ->hideFromIndex()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ]),
            Panel::make('Keterangan Kontrak', [
                Select::make('Bulan Kontrak', 'bulan')
                    ->rules('required', function ($attribute, $value, $fail) {
                        if (Carbon::createFromDate(session('year'), $value)->startOfMonth() < $this->tanggal_kak) {
                            return $fail('Bulan Kontrak harus berisi tanggal setelah atau sama dengan awal bulan tanggal KAK.');
                        }
                    })
                    ->options(Helper::$bulan)
                    ->filterable()
                    ->displayUsingLabels(),
                Select::make('Jenis Kontrak', 'jenis_kontrak')
                    ->rules('required')
                    ->filterable()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(JenisKontrak::cache()->get('all')->where('id', $kode)->first(),'jenis'))
                    ->dependsOn('tanggal_kak', function (Select $field, NovaRequest $request, FormData $form) {
                        $field->options(Helper::setOptionJenisKontrak($form->tanggal_kak));
                    }),
                Text::make('Jabatan Petugas', 'objek_sk')
                    ->help('Contoh: Petugas Pemeriksa Lapangan Sensus Penduduk 2020')
                    ->rules('required')
                    ->hideFromIndex(),
            ]),

            Panel::make('Keterangan Anggaran', [
                Text::make('MAK', 'mak')
                    ->readonly()
                    ->hideFromIndex(),
                Select::make('Detail', 'kamus_anggaran_id')
                    ->dependsOn('mak', function (Select $field, NovaRequest $request, FormData $form) {
                        $field->options(Helper::setOptions(Helper::getCollectionDetailAkun($form->mak), 'id', 'detail'));
                    })
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KamusAnggaran::cache()->get('all')->where('id', $kode)->first(), 'detail')),
                Text::make('Satuan Pembayaran', 'satuan')
                    ->rules('required')
                    ->hideFromIndex()
                    ->help('Contoh Satuan Pembayaran: Dokumen, Ruta, BS')
                    ->dependsOn('kamus_anggaran_id', function (Text $field, NovaRequest $request, FormData $formData) {
                            $field->setValue(Helper::getPropertyFromCollection(KamusAnggaran::cache()->get('all')->where('id', $formData->kamus_anggaran_id)->first(), 'satuan'));
                    }),
                Text::make('Tim Kerja', 'unit_kerja_id')
                    ->onlyOnIndex()
                    ->showOnIndex(fn () => session('role') == 'ppk')
                    ->readOnly(),
            ]),

            Panel::make('Keterangan Surat Keputusan', [
                Boolean::make('Buat Surat Keputusan (SK)', 'generate_sk')
                    ->hideFromIndex(),
                Date::make('Tanggal SK', 'tanggal_sk')
                    ->hide()
                    ->dependsOn('generate_sk', function (Date $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_sk) {
                            $field->show()
                                ->rules('required', 'before_or_equal:today', 'after_or_equal:tanggal_kak');
                        }
                    })
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->hideFromIndex(),
                BelongsTo::make('Nomor SK', 'skNaskahKeluar', 'App\Nova\NaskahKeluar')
                    ->onlyOnDetail(),
            ]),

            Panel::make('Keterangan Surat Tugas', [
                Boolean::make('Buat Surat Tugas', 'generate_st')
                    ->hideFromIndex(),
                Date::make('Tanggal Surat Tugas', 'tanggal_st')
                    ->hide()
                    ->dependsOn('generate_st', function (Date $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_st) {
                            $field->show()
                                ->rules('required', 'before_or_equal:today', 'after_or_equal:tanggal_kak');
                        }
                    })
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->hideFromIndex(),
                BelongsTo::make('Nomor ST', 'stNaskahKeluar', 'App\Nova\NaskahKeluar')
                    ->onlyOnDetail(),

                Text::make('Uraian Tugas', 'uraian_tugas')
                    ->hide()
                    ->help('Contoh: Melakukan Pencacahan Lapangan Sensus Penduduk 2020')
                    ->dependsOn('generate_st', function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_st) {
                            $field->show()
                                ->rules('required');
                        }
                    })
                    ->hideFromIndex(),
                Select::make('Klasifikasi Arsip', 'kode_arsip_id')
                    ->searchable()
                    ->hide()
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->dependsOn(['generate_st', 'tanggal_st'], function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_st) {
                            $field->rules('required')
                                ->show()
                                ->options(Helper::setOptionsKodeArsip($formData->tanggal_st));
                        }
                    }),

            ]),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat', 'import', 'diubah'])
                ->failedWhen(['gagal'])->onlyOnIndex(),

            Panel::make('Penanda Tangan', [
                Select::make('Pembuat Daftar', 'koordinator_user_id')
                    ->rules('required')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_spj', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('koordinator', Helper::createDateFromString($formData->tanggal_spj)));
                    }),
                Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                    ->rules('required')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_spj', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal_spj)));
                    }),
                Select::make('Bendahara', 'bendahara_user_id')
                    ->rules('required')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_spj', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('bendahara', Helper::createDateFromString($formData->tanggal_spj)));
                    }),
            ]),
            Tabs::make('Daftar Honor', [
                HasMany::make('Daftar Honor Mitra'),
                HasMany::make('Daftar Honor Pegawai'),
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('koordinator,ppk,bendahara,ppspm,anggota')->get()) {
            $actions[] =
                Download::make('spj', 'Unduh SPJ')
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex()
                    ->confirmButtonText('Unduh');
        }

        return $actions;
    }
}