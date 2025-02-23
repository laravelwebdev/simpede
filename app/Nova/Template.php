<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Template extends Resource
{
    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Template';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Template>
     */
    public static $model = \App\Models\Template::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama';

    public function subtitle()
    {
        return Helper::TEMPLATE[$this->jenis];
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nama', 'jenis',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Nama Template', 'nama')
                ->sortable()
                ->rules('required', 'max:80'),
            Select::make('Jenis Template', 'jenis')
                ->sortable()
                ->searchable()
                ->rules('required')
                ->displayUsingLabels()
                ->filterable()
                ->options(Helper::TEMPLATE),
            File::make('File')
                ->disk('templates')
                ->rules('mimes:xlsx,pdf,docx')
                ->acceptedTypes('.pdf,.docx,.xlsx')
                ->creationRules('required')
                ->prunable(),
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
