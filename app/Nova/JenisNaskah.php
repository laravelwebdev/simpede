<?php

namespace App\Nova;

use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class JenisNaskah extends Resource
{
    public static $with = ['kodeNaskah'];

    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Jenis Naskah';
    }

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
                ->rules('required'),
            BelongsTo::make('Kategori', 'kodeNaskah', 'App\Nova\KodeNaskah')
                ->rules('required')
                ->filterable(),
            File::make('Template')
                ->disk('template_naskah')
                ->rules('mimes:docx')
                ->acceptedTypes('.docx'),
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
            BelongsTo::make('Kategori', 'kodeNaskah', 'App\Nova\KodeNaskah')
                ->rules('required')
                ->filterable(),
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
        return [];
    }
}
