<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Query\Search\SearchableText;

class DaftarSp2d extends Resource
{
    public static $with = ['kerangkaAcuan', 'realisasiAnggaran'];

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
        return ['tanggal_sp2d', 'nomor_sp2d', 'nomor_spp', new SearchableText('uraian')];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Date::make('Tanggal SP2D', 'tanggal_sp2d')
                ->sortable()
                ->readonly()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),

            Text::make('Nomor SPP', 'nomor_spp')
                ->sortable()
                ->readonly(),

            Text::make('Nomor SP2D', 'nomor_sp2d')
                ->sortable()
                ->copyable()
                ->readonly(),

            Text::make('Uraian', 'uraian')
                ->sortable()
                ->readonly(),

            Select::make('KAK', 'kerangka_acuan_count')
                ->options([
                    0 => 'Belum Ada KAK',
                ])
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->has('kerangkaAcuan', '<=', $value);
                })
                ->onlyOnDetail(),
            Panel::make('Arsip', [
                File::make('Arsip', 'arsip_spm')
                    ->disk('arsip')
                    ->rules('mimes:pdf')
                    ->acceptedTypes('.pdf')
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'SPM_'.$this->nomor_spp;
                        $extension = $request->arsip_spm->getClientOriginalExtension();

                        return $originalName.'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_spm ?
                URL::make('Arsip SPM', fn () => Storage::disk('arsip')
                    ->url($this->arsip_spm))
                    ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                    :
                Text::make('Arsip SPM', fn () => '—')->onlyOnIndex(),

                File::make('Arsip SP2D', 'arsip_sp2d')
                    ->disk('arsip')
                    ->rules('mimes:pdf')
                    ->acceptedTypes('.pdf')
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey().'/'.$this->nomor_spp)
                    ->storeAs(function (Request $request) {
                        $originalName = 'SP2D_'.$this->nomor_spp;
                        $extension = $request->arsip_sp2d->getClientOriginalExtension();

                        return $originalName.'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,ppspm')->get())
                    ->prunable(),
                $this->arsip_sp2d ?
                URL::make('Arsip SP2D', fn () => Storage::disk('arsip')
                    ->url($this->arsip_sp2d))
                    ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                    :
                Text::make('Arsip SP2D', fn () => '—')->onlyOnIndex(),
            ]),
            HasMany::make('Realisasi Anggaran', 'realisasiAnggaran', 'App\Nova\RealisasiAnggaran'),
            BelongsToMany::make('Kerangka Acuan Kerja', 'kerangkaAcuan', 'App\Nova\KerangkaAcuan')
                ->searchable()
                ->withSubtitles(),
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal_sp2d', session('year'))->withCount('kerangkaAcuan');
    }

    public static function relatableKerangkaAcuans(NovaRequest $request, $query)
    {
        $dipa_id = $request->findModel()->dipa_id;

        return $query->where('dipa_id', $dipa_id)
            ->whereIn('id', function ($query) use ($request) {
                $query->select('kerangka_acuan_id')
                    ->from('anggaran_kerangka_acuans')
                    ->whereIn('mata_anggaran_id', function ($subQuery) use ($request) {
                        $subQuery->select('mata_anggaran_id')
                            ->from('realisasi_anggarans')
                            ->where('daftar_sp2d_id', $request->resourceId);
                    });
            });
    }
}
