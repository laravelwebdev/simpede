<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\BerkaskanArsip;
use App\Nova\Filters\Keberadaan;
use App\Nova\Filters\KelengkapanBerkas;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricValue;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;

class KakSp2d extends Resource
{
    public static $with = ['kerangkaAcuan', 'daftarSp2d', 'arsipKeuangan', 'kerangkaAcuan.naskahKeluar', 'daftarSp2d.dipa'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KakSp2d>
     */
    public static $model = \App\Models\KakSp2d::class;

    public static function label()
    {
        return 'Pemberkasan Arsip';
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
        'kerangkaAcuan.naskahKeluar.nomor', 'daftarSp2d.nomor_sp2d', 'kerangkaAcuan.rincian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Stack::make('KAK', 'tanggal', [
                BelongsTo::make('KAK', 'kerangkaAcuan', KerangkaAcuan::class)
                    ->sortable(),
                Date::make('Tanggal KAK', 'kerangkaAcuan.naskahKeluar.tanggal')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Stack::make('SPM', 'tanggal', [
                BelongsTo::make('SPM', 'daftarSp2d', DaftarSp2d::class)
                    ->sortable()
                    ->searchable(),
                Date::make('Tanggal SPM', 'daftarSp2d.tanggal_spm')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Rincian KAK', 'kerangkaAcuan.rincian')
                ->sortable(),
            BelongsTo::make('Arsip Keuangan', 'arsipKeuangan', ArsipKeuangan::class)
                ->sortable()
                ->searchable(),
            Textarea::make('Catatan', 'catatan')
                ->help('Isi hanya jika ada arsip yang kurang atau tidak sesuai. Kosongkan jika berkas sudah lengkap.')
                ->alwaysShow(),
            Boolean::make('Lengkap', function () {
                return is_null($this->catatan) && ! is_null($this->arsip_keuangan_id);
            }),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = static::$model::query();

        return [
            MetricValue::make($model, 'jumlah-berkas')
                ->width('1/3')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Rekap Pengarsipan Berkas', $model, 'arsip_keuangan_id', 'keberadaan-arsip-keuangan')
                ->setAdaLabel('Sudah Diarsipkan')
                ->width('1/3')
                ->setTidakAdaLabel('Belum Diarsipkan')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Kelengkapan Arsip Keuangan', $model, 'catatan', 'kelengkapan-arsip-keuangan')
                ->width('1/3')
                ->setAdaLabel('Belum Lengkap')
                ->setTidakAdaLabel('Lengkap')
                ->invertColors()
                ->refreshWhenActionsRun(),
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
            Keberadaan::make('Keberadaan Arsip Keuangan', 'arsip_keuangan_id')->is_null(),
            KelengkapanBerkas::make('Kelengkapan Berkas'),
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
        if (Policy::make()->allowedFor('admin,arsiparis')->get()) {
            $actions[] = BerkaskanArsip::make()->sole()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->arsip_keuangan_id !== null;
                });
            $actions[] = BerkaskanArsip::make(true)->sole()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->arsip_keuangan_id === null;
                });
        }

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereIn('daftar_sp2d_id', function ($q) {
            $q->select('id')
                ->from('daftar_sp2ds')
                ->whereIn('dipa_id', function ($qq) {
                    $qq->select('id')
                        ->from('dipas')
                        ->where('tahun', session('year'));
                });
        });
    }
}
