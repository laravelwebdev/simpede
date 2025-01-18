<?php

namespace App\Nova;

use App\Nova\Actions\AddHasManyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Filepond\Filepond;

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

    public function subtitle()
    {
        return $this->kerangkaAcuan->rincian;
    }

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
            Filepond::make('File')
                ->disk('arsip')
                ->disableCredits()
                ->rules('required')
                ->mimesTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->path(session('year').'/'.static::uriKey().'/'.$request->viaResourceId)
                ->dependsOn(
                    ['slug'],
                    function (File $field, NovaRequest $request, FormData $formData) {
                        $field->storeAs(function (Request $request) use ($formData) {
                            $originalName = Str::slug($formData->slug);
                            $extension = $request->file->getClientOriginalExtension();

                            return $originalName.'_'.uniqid().'.'.$extension;
                        });
                    }
                )
                ->prunable(),
            $this->file ?
            URL::make('Arsip', fn () => Storage::disk('arsip')
                ->url($this->file))
                ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                :
            Text::make('Arsip', fn () => '—')->onlyOnIndex(),
        ];
    }

    public function fieldsForHasMany(NovaRequest $request)
    {
        return [
            Text::make('Jenis Dokumen', 'slug')
                ->sortable()
                ->rules('required'),
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
                ->addFields($this->fieldsForHasMany($request)),
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
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'kerangka-acuans'.'/';
    }
}
