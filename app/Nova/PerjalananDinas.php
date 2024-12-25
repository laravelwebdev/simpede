<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\AnggaranKerangkaAcuan;
use App\Models\KodeArsip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class PerjalananDinas extends Resource
{
    public static $with = ['spdNaskahKeluar', 'stNaskahKeluar', 'tujuanMasterWilayah', 'kerangkaAcuan', 'daftarPesertaPerjalanan', 'ppk', 'kepala', 'mataAnggaran'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PerjalananDinas>
     */
    public static $model = \App\Models\PerjalananDinas::class;

    public static function label()
    {
        return 'Perjalanan Dinas';
    }

    public static function singularLabel()
    {
        return 'Perjalanan Dinas';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'spdNaskahKeluar.nomor';

    public function subtitle()
    {
        return $this->uraian;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'uraian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('Kerangka Acuan ID', 'kerangka_acuan_id'),
            Stack::make('Nomor/Tanggal KAK', [
                BelongsTo::make('Nomor:', 'kerangkaAcuan', 'App\Nova\KerangkaAcuan'),
                Date::make('Tanggal:', 'kerangkaAcuan.tanggal')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ]),
            Select::make('Jenis Perjalanan', 'jenis')
                ->options(Helper::$jenis_perjalanan)
                ->rules('required')
                ->hideFromIndex()
                ->displayUsingLabels(),
            Stack::make('Nomor/Tanggal Surat Tugas', 'tanggal_st', [
                Text::make('Nomor:', 'stNaskahKeluar.nomor')->copyable(),
                Date::make('Tanggal:', 'tanggal_st')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Stack::make('Nomor/Tanggal SPPD', 'tanggal_spd', [
                Text::make('Nomor:', 'spdNaskahKeluar.nomor')->copyable(),
                Date::make('Tanggal:', 'tanggal_spd')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Uraian', 'uraian')
                ->rules('required'),
            Panel::make('Surat Tugas', [
                BelongsTo::make('Surat Tugas', 'stNaskahKeluar', 'App\Nova\NaskahKeluar')
                    ->searchable()
                    ->withSubtitles()
                    ->help('kosongkan jika ingin membuat nomor baru secara otomatis')
                    ->hideFromIndex(),
                Date::make('Tanggal Surat Tugas', 'tanggal_st')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->show()
                    ->dependsOn('stNaskahKeluar', function (Date $field, NovaRequest $request, FormData $formData) {
                        if (empty($formData->stNaskahKeluar)) {
                            $field->rules('required', 'before_or_equal:tanggal_berangkat', 'before_or_equal:today');
                        } else {
                            $field->hide();
                        }
                    })
                    ->onlyOnForms(),
                Select::make('Klasifikasi Arsip ST', 'st_kode_arsip_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->show()
                    ->dependsOn(['tanggal_st', 'stNaskahKeluar'], function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionsKodeArsip($formData->tanggal_st));
                        if (empty($formData->stNaskahKeluar)) {
                            $field->rules('required');
                        } else {
                            $field->hide();
                        }
                    }),
                Select::make('Penanda Tangan', 'kepala_user_id')
                    ->rules('required')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_st', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('kepala', Helper::createDateFromString($formData->tanggal_st)));
                    }),
            ]),
            Panel::make('Surat Perjalanan Dinas', [
                Date::make('Tanggal SPD', 'tanggal_spd')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->rules('required', 'before_or_equal:tanggal_berangkat', 'after_or_equal:tanggal_st', 'before_or_equal:today')
                    ->onlyOnForms(),
                Select::make('Klasifikasi Arsip SPD', 'spd_kode_arsip_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->rules('required')
                    ->dependsOn(['tanggal_spd'], function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionsKodeArsip($formData->tanggal_spd));
                    }),
                Select::make('Penanda Tangan', 'ppk_user_id')
                    ->rules('required')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_spd', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal_spd)));
                    }),
            ]),
            Date::make('Tanggal Berangkat', 'tanggal_berangkat')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Date::make('Tanggal Kembali', 'tanggal_kembali')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            BelongsTo::make('Tujuan', 'tujuanMasterWilayah', 'App\Nova\MasterWilayah')
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            BelongsTo::make('Mata Anggaran', 'mataAnggaran', 'App\Nova\MataAnggaran')
                ->searchable()
                ->withSubtitles()
                ->hideFromIndex()
                ->rules('required')
                ->dependsOn('kerangka_acuan_id', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        $mataAnggaranIds = AnggaranKerangkaAcuan::where('kerangka_acuan_id', $formData->kerangka_acuan_id)
                            ->whereHas('mataAnggaran', function ($query) {
                                $query->whereIn(DB::raw('SUBSTRING(mak, 30, 6)'), Helper::$akun_perjalanan);
                            })
                            ->pluck('mata_anggaran_id');

                        return $query->whereIn('id', $mataAnggaranIds);
                    });
                }),
            HasMany::make('Daftar Peserta Perjalanan', 'daftarPesertaPerjalanan', 'App\Nova\DaftarPesertaPerjalanan')
                ->canSee(fn () => $this->jenis === '1'),

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
}
