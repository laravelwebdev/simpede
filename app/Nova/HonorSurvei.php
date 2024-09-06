<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\KodeArsip;
use App\Models\User;
use App\Nova\Actions\ImportDaftarHonor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;

class HonorSurvei extends Resource
{
    public static $with = ['kerangkaAcuan', 'daftarHonor'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\HonorSurvei>
     */
    public static $model = \App\Models\HonorSurvei::class;

    public static function label()
    {
        return 'Honor Survei';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
                    ->rules('required')
                    ->hideFromIndex()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ]),
            Panel::make('Keterangan Kontrak', [
                Select::make('Bulan Kontrak', 'bulan')
                    ->rules('required')
                    ->options(Helper::$bulan)
                    ->filterable()
                    ->displayUsingLabels(),
                Select::make('Jenis Kontrak', 'jenis_kontrak')
                    ->rules('required')
                    ->filterable()
                    ->displayUsingLabels()
                    ->dependsOn('bulan', function (Select $field, NovaRequest $request, FormData $form) {
                        $field->options(Helper::setOptionJenisKontrak(session('year'), $form->bulan));
                    }),
                Text::make('Satuan Pembayaran', 'satuan')
                    ->rules('required')
                    ->hideFromIndex()
                    ->help('Contoh Satuan Pembayaran: Dokumen, Ruta, BS'),
            ]),

            Panel::make('Keterangan Anggaran', [
                Text::make('MAK', 'mak')
                    ->readonly()
                    ->hideFromIndex(),
                Select::make('Detail', 'detail')
                    ->rules('required')
                    ->dependsOn('mak', function (Select $field, NovaRequest $request, FormData $form) {
                        $field->options(Helper::setOptions(Helper::getCollectionDetailAkun($form->mak), 'detail', 'detail'));
                    })
                    ->hideFromIndex(),
                Text::make('Tim Kerja', 'unit_kerja_id')
                    ->onlyOnIndex()
                    ->showOnIndex(fn () => session('role') == 'ppk')
                    ->readOnly(),
            ]),

            Panel::make('Keterangan Surat Keputusan', [
                Boolean::make('Buat Surat Keputusan (SK)', 'generate_sk')
                    ->trueValue('Ya')
                    ->falseValue('Tidak')
                    ->hideFromIndex(),
                Date::make('Tanggal SK', 'tanggal_sk')                    
                    ->hide()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->dependsOn('generate_sk', function (Date $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_sk) {
                            $field->show()
                            ->rules('required');
                        }
                    })->hideFromIndex(),
                Text::make('Objek SK', 'objek_sk')                    
                    ->hide()
                    ->help('Contoh: Petugas Pemeriksa Lapangan Sensus Penduduk 2020')
                    ->dependsOn('generate_sk', function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_sk) {
                            $field->show()
                            ->rules('required');
                        }
                    })
                    ->hideFromIndex(),

            ]),

            Panel::make('Keterangan Surat Tugas', [
                Boolean::make('Buat Surat Tugas', 'generate_st')
                    ->trueValue('Ya')
                    ->falseValue('Tidak')
                    ->hideFromIndex(),
                Date::make('Tanggal Surat Tugas', 'tanggal_st')                    
                    ->hide()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->dependsOn('generate_st', function (Date $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_st) {
                            $field->show()
                            ->rules('required');
                        }
                    })->hideFromIndex(),
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
                    ->rules('required')
                    ->searchable()
                    ->hide()
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => KodeArsip::cache()->get('all')->where('id', $kode)->first()->kode)
                    ->dependsOn('generate_st', function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->generate_st) {
                            $field->show()
                            ->rules('required')
                            ->options(Helper::setOptions(KodeArsip::cache()->get('all'), 'id', 'detail', 'group'));
                        }
                    }),

            ]),


            Panel::make('Keterangan Petugas Organik', [
                SimpleRepeatable::make('Pegawai', 'pegawai', [
                    Select::make('Nama Pegawai', 'user_id')
                        ->rules('required')
                        ->searchable()
                        ->options(Helper::setOptions(User::cache()->get('all'), 'id', 'nama'))
                        ->displayUsingLabels(),
                ])->rules('required',
                    function ($attribute, $value, $fail) {
                        if (Helper::cekGanda(json_decode($value), 'user_id')) {
                            return $fail('validation.unique')->translate();
                        }
                    }),
            ]),

            HasMany::make('Daftar Honor', 'daftarHonor', 'App\Nova\DaftarHonor'),
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
        if (session('role') == 'koordinator') {
            return [
                ImportDaftarHonor::make()->onlyOnDetail()->confirmButtonText('Import')
                    ->canSee(function ($request) {
                        if ($request instanceof ActionRequest) {
                            return true;
                        }

                        return $this->resource instanceof Model && $this->resource->bulan !== null;
                    }),
            ];
        } else {
            return [];
        }
    }
}
