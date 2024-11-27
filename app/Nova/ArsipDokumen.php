<?php

namespace App\Nova;

use App\Nova\Actions\AddHasManyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class ArsipDokumen extends Resource
{
    public static $with = ['kerangkaAcuan'];

    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Arsip Dokumen';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ArsipDokumen>
     */
    public static $model = \App\Models\ArsipDokumen::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'slug';

    public static $subtitle = 'kerangkaAcuan.rincian';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'slug',
        'kerangkaAcuan.rincian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Jenis Dokumen', 'slug')
                ->sortable()
                ->rules('required'),
            File::make('File')
                ->disk('arsip')
                ->rules('mimes:xlsx,pdf,docx')
                ->acceptedTypes('.pdf,.docx,.xlsx')
                ->creationRules('required')
                ->path(session('year').'/'.static::uriKey())
                ->storeAs(function (Request $request) {
                    $originalName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $request->file->getClientOriginalExtension();

                    return $originalName.'_'.uniqid().'.'.$extension;
                })
                ->prunable(),
            $this->file ?
            URL::make('Arsip', fn () => Storage::disk('arsip')
                ->url($this->file))
                ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                :
            Text::make('Arsip', fn () => '—')->onlyOnIndex(),
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
        return [
            AddHasManyModel::make('ArsipDokumen', 'KerangkaAcuan', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fields($request)),
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Detail=arsip-dokumen' : '/'.'resources'.'/'.'kerangka-acuans'.'/';
    }
}
