<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\DaftarSp2d as ModelsDaftarSp2d;
use App\Models\KerangkaAcuan;
use App\Nova\KerangkaAcuan as ResourceKerangkaAcuan;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasManyThrough;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Filepond\Filepond;
use Laravelwebdev\Numeric\Numeric;

class DaftarSp2d extends Resource
{
    public static $with = ['kerangkaAcuan', 'realisasiAnggaran', 'arsipKeuangans', 'dipa'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarSp2d>
     */
    public static $model = \App\Models\DaftarSp2d::class;

    public static function label()
    {
        return 'Daftar SP2D';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->nomor_spp;
    }

    public function subtitle()
    {
        return $this->uraian;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function searchableColumns()
    {
        return ['tanggal_sp2d', 'nomor_sp2d', 'nomor_spp', 'uraian'];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Stack::make('SP2D', 'tanggal_sp2d', [
                Text::make('Nomor SP2D', 'nomor_sp2d')
                    ->sortable()
                    ->copyable()
                    ->readonly(),
                Date::make('Tanggal SP2D', 'tanggal_sp2d')
                    ->sortable()
                    ->readonly()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Stack::make('SPM', 'nomor_spp', [
                Text::make('Nomor SPM', 'nomor_spp')
                    ->sortable()
                    ->copyable()
                    ->readonly(),
                Date::make('Tanggal SPM', 'tanggal_spm')
                    ->sortable()
                    ->readonly()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),

            Text::make('Uraian', 'uraian')
                ->sortable()
                ->readonly(),
            Numeric::make('Jumlah', 'jumlah')
                ->sortable()
                ->exceptOnForms(),

            Select::make('KAK', 'kerangka_acuan_count')
                ->options([
                    0 => 'Belum Ada KAK',
                ])
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->has('kerangkaAcuan', '<=', $value);
                })
                ->onlyOnDetail(),
            Panel::make('Arsip', [
                Filepond::make('SPP', 'arsip_spp')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->mimesTypes(['application/pdf'])
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'SPP_'.$this->nomor_spp;
                        $extension = $request->arsip_spp->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_spp ?
                URL::make('SPP', fn () => Storage::disk('arsip')
                    ->url($this->arsip_spp))
                    ->displayUsing(fn () => 'Lihat')->onlyOnDetail()
                    :
                Text::make('SPP', fn () => null)->onlyOnDetail(),

                Filepond::make('Lampiran SPP', 'arsip_lampiran_spp')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->mimesTypes(['application/pdf'])
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'Lampiran_SPP_'.$this->nomor_spp;
                        $extension = $request->arsip_lampiran_spp->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_lampiran_spp ?
                URL::make('Lampiran SPP', fn () => Storage::disk('arsip')
                    ->url($this->arsip_lampiran_spp))
                    ->displayUsing(fn () => 'Lihat')->onlyOnDetail()
                    :
                Text::make('Lampiran SPP', fn () => null)->onlyOnDetail(),

                Filepond::make('SPM', 'arsip_spm')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->mimesTypes(['application/pdf'])
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'SPM_'.$this->nomor_spp;
                        $extension = $request->arsip_spm->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_spm ?
                URL::make('SPM', fn () => Storage::disk('arsip')
                    ->url($this->arsip_spm))
                    ->displayUsing(fn () => 'Lihat')->onlyOnDetail()
                    :
                Text::make('SPM', fn () => null)->onlyOnDetail(),

                Filepond::make('Lampiran SPM', 'arsip_lampiran')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->mimesTypes(['application/pdf'])
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'Lampiran_SPM_'.$this->nomor_spp;
                        $extension = $request->arsip_lampiran->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_lampiran ?
                URL::make('Lampiran SPM', fn () => Storage::disk('arsip')
                    ->url($this->arsip_lampiran))
                    ->displayUsing(fn () => 'Lihat')->onlyOnDetail()
                    :
                Text::make('Lampiran SPM', fn () => null)->onlyOnDetail(),

                Filepond::make('DPT', 'arsip_dpt')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->mimesTypes(['application/pdf'])
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'DPT_'.$this->nomor_spp;
                        $extension = $request->arsip_dpt->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_dpt ?
                URL::make('DPT', fn () => Storage::disk('arsip')
                    ->url($this->arsip_dpt))
                    ->displayUsing(fn () => 'Lihat')->onlyOnDetail()
                    :
                Text::make('DPT', fn () => null)->onlyOnDetail(),

                Filepond::make('SSP', 'arsip_ssp')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->mimesTypes(['application/pdf'])
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'SSP_'.$this->nomor_spp;
                        $extension = $request->arsip_ssp->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_ssp ?
                URL::make('SSP', fn () => Storage::disk('arsip')
                    ->url($this->arsip_ssp))
                    ->displayUsing(fn () => 'Lihat')->onlyOnDetail()
                    :
                Text::make('SSP', fn () => null)->onlyOnDetail(),

                Filepond::make('SP2D', 'arsip_sp2d')
                    ->disk('arsip')
                    ->onlyOnForms()
                    ->disableCredits()
                    ->mimesTypes(['application/pdf'])
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'SP2D_'.$this->nomor_spp;
                        $extension = $request->arsip_sp2d->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_sp2d ?
                URL::make('SP2D', fn () => Storage::disk('arsip')
                    ->url($this->arsip_sp2d))
                    ->displayUsing(fn () => 'Lihat')->onlyOnDetail()
                    :
                Text::make('SP2D', fn () => null)->onlyOnDetail(),

            ]),
            BelongsToMany::make('Kerangka Acuan Kerja', 'kerangkaAcuan', ResourceKerangkaAcuan::class)
                ->searchable()
                ->withSubtitles(),
            HasMany::make('Realisasi Anggaran', 'realisasiAnggaran', RealisasiAnggaran::class),

            HasManyThrough::make('Arsip Keuangan', 'arsipKeuangans', ArsipKeuangan::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsDaftarSp2d::whereYear('tanggal_sp2d', session('year'));
        $kak = KerangkaAcuan::whereYear('tanggal', session('year'));

        return [
            MetricValue::make($model, 'total-sp2d')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('SP2D', $model->withcount('kerangkaAcuan'), 'kerangka_acuan_count', 'kerangka-acuan-terlampir')
                ->setAdaLabel('Ada KAK')
                ->nullStrict(false)
                ->setTidakAdaLabel('Tidak Ada KAK')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('KAK', $kak->withcount('daftarSp2d'), 'daftar_sp2d_count', 'sp2d-tidak-terlampir')
                ->refreshWhenActionsRun()
                ->nullStrict(false)
                ->setAdaLabel('Ada SP2D')
                ->setTidakAdaLabel('Tidak Ada SP2D'),
        ];
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal_sp2d', session('year'));
    }

    public static function relatableKerangkaAcuans(NovaRequest $request, $query)
    {
        $dipa_id = $request->findModel()->dipa_id;

        return $query->where('dipa_id', $dipa_id)
            ->whereIn('id', function ($query) use ($request) {
                if (DB::table('realisasi_anggarans')
                    ->where('daftar_sp2d_id', $request->resourceId)
                    ->exists()
                ) {
                    $query->select('kerangka_acuan_id')
                        ->from('anggaran_kerangka_acuans')
                        ->whereIn('mata_anggaran_id', function ($subQuery) use ($request) {
                            $subQuery->select('mata_anggaran_id')
                                ->from('realisasi_anggarans')
                                ->where('daftar_sp2d_id', $request->resourceId);
                        });
                } else {
                    $query->select('id')->from('kerangka_acuans');
                }
            });
    }
}
