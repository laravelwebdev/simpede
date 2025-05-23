<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Filepond\Filepond;

class JenisNaskah extends Resource
{
    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Jenis Naskah';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\JenisNaskah>
     */
    public static $model = \App\Models\JenisNaskah::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'jenis';

    public static $globallySearchable = false;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenis',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Jenis')
                ->rules('required', 'max:100'),
            Filepond::make('Template')
                ->disk('template_naskah')
                ->disableCredits()
                ->mimesTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->onlyOnForms()
                ->prunable(),
            URL::make('Template', fn () => ($this->template == '') ? '' : Storage::disk('template_naskah')
                ->url($this->template))
                ->displayUsing(fn () => 'Unduh')
                ->exceptOnForms(),
        ];
    }

    public function fieldsForHasMany(NovaRequest $request)
    {
        return [
            Text::make('Jenis')
                ->rules('required'),

        ];
    }

    /**
     * Get the fields displayed by the resource on the index.
     *
     * @return array
     */
    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            Text::make('Jenis')
                ->rules('required'),
            URL::make('Template', fn () => ($this->template == '') ? '' : Storage::disk('template_naskah')
                ->url($this->template))
                ->displayUsing(fn () => 'Unduh'),
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
        $actions = [];
        if (Policy::make()->allowedFor('admin')->get() && $request->viaResource === 'kode-naskahs') {
            $actions[] =
            AddHasManyModel::make('JenisNaskah', 'KodeNaskah', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                // ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fieldsForHasMany($request));
        }

        return $actions;
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'tata-naskahs'.'/';
    }
}
