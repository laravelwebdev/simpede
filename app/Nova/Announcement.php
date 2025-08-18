<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Announcement extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Announcement>
     */
    public static $model = \App\Models\Announcement::class;

    public static function label()
    {
        return 'Pengumuman';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    public function subtitle()
    {
        return Helper::terbilangTanggal($this->created_at);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title', 'description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Judul', 'title')
                ->rules('required', 'max:255'),
            Textarea::make('Deskripsi', 'description')
                ->rules('required')
                ->alwaysShow(),
            Text::make('Link', 'link')
                ->rules('required', 'url'),
            Image::make('Image')
                ->disk('announcement')
                ->creationRules('required')
                ->disableDownload()
                ->hideFromIndex()
                ->prunable()
                ->help('Ukuran landscape 2:1'),

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
