<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\BerkaskanArsip;
use App\Nova\Actions\UbahStatusRekap;
use App\Nova\Filters\Keberadaan;
use App\Nova\Filters\KelengkapanBerkas;
use App\Nova\Lenses\MonitoringRekapBos;
use App\Nova\Lenses\MonitoringRekapSirup;
use App\Nova\Metrics\MetricKeberadaan;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;

class KakSp2d extends Resource
{
    public static $with = ['kerangkaAcuan', 'daftarSp2d', 'arsipKeuangan', 'kerangkaAcuan.naskahKeluar', 'daftarSp2d.dipa', 'arsipDokumens'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KakSp2d>
     */
    public static $model = \App\Models\KakSp2d::class;

    public static function label()
    {
        return 'Pemberkasan Arsip Keuangan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $globallySearchable = false;

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
        if ($request->viaResource === 'kerangka-acuans') {
            return [
                Stack::make('Nomor SPM/Tanggal', [
                    Text::make('Nomor SPM', 'daftarSp2d.nomor_spp')
                        ->resolveUsing(fn ($nomorSpp) => $nomorSpp ? $nomorSpp.'/'.config('satker.kode').'/'.session('year') : '-')
                        ->copyable(),
                    Date::make('Tanggal SPM', 'daftarSp2d.tanggal_spm')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                ]),
                Stack::make('Nomor SP2D/Tanggal', [
                    Text::make('Nomor SP2D', 'daftarSp2d.nomor_sp2d')
                        ->copyable(),
                    Date::make('Tanggal SP2D', 'daftarSp2d.tanggal_sp2d')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                ]),
                BelongsTo::make('Arsip Keuangan', 'arsipKeuangan', ArsipKeuangan::class)
                    ->sortable()
                    ->searchable(),
            ];
        }

        return [
            Stack::make('KAK', 'kerangkaAcuan.naskahKeluar.tanggal', [
                Text::make('Nomor SPM', 'kerangkaAcuan.naskahKeluar.nomor')
                    ->copyable(),
                Date::make('Tanggal KAK', 'kerangkaAcuan.naskahKeluar.tanggal')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->onlyOnDetail(),
            Stack::make('KAK', 'kerangkaAcuan.naskahKeluar.tanggal', [
                BelongsTo::make('KAK', 'kerangkaAcuan', KerangkaAcuan::class),
                Date::make('Tanggal KAK', 'kerangkaAcuan.naskahKeluar.tanggal')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->hideFromDetail(),
            Stack::make('SPM', 'daftarSp2d.tanggal_spm', [
                Text::make('Nomor SPM', 'daftarSp2d.nomor_spp')
                    ->resolveUsing(fn ($nomorSpp) => $nomorSpp ? $nomorSpp.'/'.config('satker.kode').'/'.session('year') : '-')
                    ->copyable(),
                Date::make('Tanggal SPM', 'daftarSp2d.tanggal_spm')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->onlyOnDetail(),
            Stack::make('SP2D', 'daftarSp2d.tanggal_spm', [
                Text::make('Nomor SP2D', 'daftarSp2d.nomor_sp2d')
                    ->copyable(),
                Date::make('Tanggal SP2D', 'daftarSp2d.tanggal_sp2d')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->onlyOnDetail(),
            Stack::make('SPM', 'daftarSp2d.tanggal_spm', [
                BelongsTo::make('SPM', 'daftarSp2d', DaftarSp2d::class)
                    ->searchable(),
                Date::make('Tanggal SPM', 'daftarSp2d.tanggal_spm')->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->hideFromDetail(),
            Text::make('Rincian KAK', 'kerangkaAcuan.rincian'),
            BelongsTo::make('Arsip Keuangan', 'arsipKeuangan', ArsipKeuangan::class)
                ->sortable()
                ->hideFromIndex()
                ->searchable(),
            Textarea::make('Catatan', 'catatan')
                ->help('Isi hanya jika ada arsip yang kurang atau tidak sesuai. Biarkan kosong jika berkas sudah sesuai.')
                ->onlyOnDetail()
                ->alwaysShow(),
            Boolean::make('Pengarsipan', function () {
                return ! is_null($this->arsip_keuangan_id);
            }),
            Boolean::make('Kesesuaian Arsip', function () {
                return is_null($this->catatan) && ! is_null($this->arsip_keuangan_id);
            }),
            Boolean::make('Rekap Sirup', 'rekap_sirup')
                ->onlyOnDetail(),
            Boolean::make('Rekap BOS', 'rekap_bos')
                ->onlyOnDetail(),
            HasMany::make('Arsip Dokumen', 'arsipDokumens', ArsipDokumen::class),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = static::indexQuery($request, static::$model::query());

        return [
            MetricKeberadaan::make('Rekap Pengarsipan Berkas', $model, 'arsip_keuangan_id', 'keberadaan-arsip-keuangan')
                ->setAdaLabel('Sudah Diarsipkan')
                ->width('1/2')
                ->setTidakAdaLabel('Belum Diarsipkan')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Kesesuaian Arsip', $model, 'catatan', 'kelengkapan-arsip-keuangan')
                ->width('1/2')
                ->setAdaLabel('Belum Sesuai')
                ->setTidakAdaLabel('Sesuai')
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
        return [
            MonitoringRekapSirup::make(),
            MonitoringRekapBos::make(),
        ];
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
            $actions[] = BerkaskanArsip::make(true)->sole()->onlyOnDetail()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->arsip_keuangan_id === null;
                });
        }
        if (Policy::make()->allowedFor('admin,arsiparis,bendahara')->get()) {
            $actions[] = UbahStatusRekap::make('bos')
                ->onlyOnDetail();
        }
        if (Policy::make()->allowedFor('admin,arsiparis,ppk')->get()) {
            $actions[] = UbahStatusRekap::make('sirup')
                ->onlyOnDetail()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->kerangkaAcuan->jenis === 'Penyedia';
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
