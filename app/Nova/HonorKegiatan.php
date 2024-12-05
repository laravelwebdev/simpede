<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\KodeArsip;
use App\Models\NaskahDefault;
use App\Models\UnitKerja;
use App\Nova\Actions\Download;
use App\Nova\Actions\ExportTemplateBos;
use App\Nova\Filters\StatusFilter;
use App\Nova\Metrics\HelperHonorKegiatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
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

    public static $with = ['kerangkaAcuan.naskahKeluar', 'daftarHonorMitra', 'skNaskahKeluar', 'stNaskahKeluar', 'daftarHonorPegawai', 'jenisKontrak', 'mataAnggaran'];

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

    public function subtitle()
    {
        return 'Status: '.$this->status;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'judul_spj', 'bulan', 'status', 'mataAnggaran.mak',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->where('tahun', session('year'));
        if (Policy::make()->allowedFor('ppk,arsiparis,bendahara,kpa,ppspm')->get()) {
            return $query;
        }
        elseif (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            return $query->where('unit_kerja_id', Helper::getDataPegawaiByUserId($request->user()->id, now())->unit_kerja_id);
        }

        return $query;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('Tanggal KAK', 'tanggal_kak'),
            Stack::make('Nomor/Tanggal KAK', 'tanggal_kak', [
                BelongsTo::make('Nomor KAK', 'kerangkaAcuan', 'App\Nova\KerangkaAcuan')
                    ->rules('required')
                    ->sortable()
                    ->readOnly()
                    ->hideWhenUpdating(),
                Date::make('Tanggal KAK', 'tanggal_kak')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Panel::make('Keterangan SPJ', [
                Text::make('Nama Kegiatan', 'kegiatan')
                    ->rules('required')
                    ->sortable()
                    ->readOnly()
                    ->hideWhenUpdating(),
                Date::make('Awal Pelaksanaan', 'awal')
                    ->rules('required', 'after_or_equal:tanggal_kak')
                    ->hideFromIndex()
                    ->readOnly()
                    ->hideWhenUpdating()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                Date::make('Akhir Penyelesaian', 'akhir')
                    ->rules('required', 'after_or_equal:awal')
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
                Select::make('Jenis Kontrak/Honor', 'jenis_honor')
                    ->rules('required')
                    ->options(Helper::$jenis_honor)
                    ->sortable()
                    ->searchable()
                    ->filterable()
                    ->displayUsingLabels(),
                Select::make('Bulan Kontrak', 'bulan')
                    ->hide()
                    ->dependsOn(['jenis_honor'], function (Select $field, NovaRequest $request, FormData $form) {
                        if ($form->jenis_honor === 'Kontrak Mitra Bulanan') {
                            $field
                                ->show()
                                ->rules('required', function ($attribute, $value, $fail) {
                                    if (Carbon::createFromDate(session('year'), $value)->startOfMonth() < $this->tanggal_kak) {
                                        return $fail('Bulan Kontrak harus berisi tanggal setelah atau sama dengan awal bulan tanggal KAK.');
                                    }
                                });
                        }
                    })
                    ->options(Helper::$bulan)
                    ->displayUsingLabels()
                    ->sortable()
                    ->searchable()
                    ->filterable(),
                Select::make('Jenis Kegiatan', 'jenis_kontrak_id')
                    ->hide()
                    ->dependsOn(['tanggal_kak', 'jenis_honor'], function (Select $field, NovaRequest $request, FormData $form) {
                        if ($form->jenis_honor === 'Kontrak Mitra Bulanan') {
                            $field
                                ->show()
                                ->options(Helper::setOptionJenisKontrak($form->tanggal_kak))
                                ->rules('required');
                        }
                    })
                    ->searchable()
                    ->onlyOnForms(),
                BelongsTo::make('Jenis Kegiatan', 'jenisKontrak', 'App\Nova\JenisKontrak')
                    ->sortable()
                    ->filterable()
                    ->exceptOnForms(),
                Text::make('Jabatan Petugas', 'objek_sk')
                    ->help('Contoh: Petugas Pemeriksa Lapangan Sensus Penduduk 2020')
                    ->rules('required')
                    ->hideFromIndex(),
            ]),

            Panel::make('Keterangan Anggaran', [
                Text::make('MAK', 'mataAnggaran.mak')
                    ->readonly(),
                BelongsTo::make('Item Mata Anggaran', 'mataAnggaran', 'App\Nova\MataAnggaran')
                    ->hideFromIndex()
                    ->readonly(),
                Text::make('Satuan Pembayaran', 'satuan')
                    ->rules('required')
                    ->hideFromIndex()
                    ->help('Contoh Satuan Pembayaran: Dokumen, Ruta, BS')
                    ->dependsOn('mataAnggaran', function (Text $field, NovaRequest $request, FormData $formData) {
                        $field->setValue(Helper::getPropertyFromCollection(Helper::getMataAnggaranById($formData->mataAnggaran), 'satuan'));
                    }),
                Text::make('Tim Kerja', 'unit_kerja_id')
                    ->onlyOnIndex()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(UnitKerja::cache()->get('all')->where('id', $id)->first(), 'unit'))
                    ->showOnIndex(fn () => Policy::make()->allowedFor('ppk')->get())
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
                Select::make('Klasifikasi Arsip', 'sk_kode_arsip_id')
                    ->searchable()
                    ->hide()
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->dependsOn(['generate_sk', 'tanggal_sk'], function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_sk) {
                            $default_naskah = NaskahDefault::cache()
                                ->get('all')
                                ->where('jenis', 'sk')
                                ->first();
                            $field->rules('required')
                                ->show()
                                ->options(Helper::setOptionsKodeArsip($formData->tanggal_sk, Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')));
                        }
                    }),
                Select::make('Kuasa Pengguna Anggaran', 'kpa_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->hide()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn(['tanggal_sk', 'generate_sk'], function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_sk) {
                            $field->show()
                                ->rules('required')
                                ->options(Helper::setOptionPengelola('kpa', Helper::createDateFromString($formData->tanggal_sk)));
                        }
                    }),
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
                Select::make('Klasifikasi Arsip', 'st_kode_arsip_id')
                    ->searchable()
                    ->hide()
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->dependsOn(['generate_st', 'tanggal_st'], function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_st) {
                            $default_naskah = NaskahDefault::cache()
                                ->get('all')
                                ->where('jenis', 'st')
                                ->first();
                            $field->rules('required')
                                ->show()
                                ->options(Helper::setOptionsKodeArsip($formData->tanggal_st, Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')));
                        }
                    }),
                Select::make('Kepala', 'kepala_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->hide()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn(['tanggal_st', 'generate_st'], function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_st) {
                            $field->show()
                                ->rules('required')
                                ->options(Helper::setOptionPengelola('kepala', Helper::createDateFromString($formData->tanggal_st)));
                        }
                    }),
            ]),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat', 'diubah'])
                ->failedWhen(['outdated'])->onlyOnIndex(),

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
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            HelperHonorKegiatan::make()
                ->width('full'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            StatusFilter::make('honor_kegiatans'),
        ];
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
            Download::make('spj', 'Unduh SPJ')
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Unduh');
            $actions[] =
            ExportTemplateBos::make()
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Export');
            $actions[] =
                Download::make('st', 'Unduh Surat Tugas')
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex()
                    ->confirmButtonText('Unduh')
                    ->canSee(function ($request) {
                        if ($request instanceof ActionRequest) {
                            return true;
                        }

                        return $this->resource instanceof Model && $this->resource->st_naskah_keluar_id !== null;
                    });
            $actions[] =
            Download::make('sk', 'Unduh SK')
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Unduh')
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->sk_naskah_keluar_id !== null;
                });
        }

        return $actions;
    }
}
