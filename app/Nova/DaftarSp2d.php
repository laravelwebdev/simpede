<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Query\Search\SearchableText;

class DaftarSp2d extends Resource
{
    public static $with = ['kerangkaAcuan'];
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
            Panel::make('Arsip', [
                File::make('Arsip', 'arsip_spm')
                    ->disk('arsip')
                    ->rules('mimes:pdf')
                    ->acceptedTypes('.pdf')
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->file->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->prunable(),
                $this->arsip_spm ?
                URL::make('Arsip SPM', fn () => Storage::disk('naskah')
                    ->url($this->arsip_spm))
                    ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                    :
                Text::make('Arsip SPM', fn () => '—')->onlyOnIndex(),

                File::make('Arsip SP2D', 'arsip_sp2d')
                    ->disk('arsip')
                    ->rules('mimes:pdf')
                    ->acceptedTypes('.pdf')
                    ->creationRules('required')
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->file->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->prunable(),
                $this->arsip_sp2d ?
                URL::make('Arsip SP2D', fn () => Storage::disk('naskah')
                    ->url($this->arsip_sp2d))
                    ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                    :
                Text::make('Arsip SP2D', fn () => '—')->onlyOnIndex(),
            ]),
            HasMany::make('Kerangka Acuan Kerja', 'kerangkaAcuan', 'App\Nova\KerangkaAcuan'),
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
