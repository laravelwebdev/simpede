<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Filepond\Filepond;

class SusenasSetting extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SusenasSetting>
     */
    public static $model = \App\Models\SusenasSetting::class;

    public static function label()
    {
        return 'Setting';
    }

    public static $globallySearchable = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'version';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'version',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Version')
                ->sortable()
                ->rules('required', 'max:20'),
            Filepond::make('APK', 'apk_file')
                ->disk('susenas')
                ->prunable()
                ->disableCredits()
                ->storeAs(function (Request $request) {
                    $originalName = 'iSusenas';
                    $extension = $request->apk_file->getClientOriginalExtension();

                    return $originalName.'.'.$extension;
                })
                ->rules('required'),
            Filepond::make('Lembar Bantu', 'lk_file')
                ->disk('susenas')
                ->disableCredits()
                ->prunable()
                ->storeAs(function (Request $request) {
                    $originalName = 'Lembar_Bantu_Susenas';
                    $extension = $request->lk_file->getClientOriginalExtension();

                    return $originalName.'.'.$extension;
                })
                ->rules('required'),
            $this->apk_file ?
                URL::make('APK', fn () => Storage::disk('susenas')
                    ->url($this->apk_file))
                    ->displayUsing(fn () => 'Unduh')->onlyOnIndex()
                    :
                Text::make('APK', fn () => null)->onlyOnIndex(),
            $this->lk_file ?
                URL::make('Lembar Bantu', fn () => Storage::disk('susenas')
                    ->url($this->lk_file))
                    ->displayUsing(fn () => 'Unduh')->onlyOnIndex()
                    :
                Text::make('Lembar Bantu', fn () => null)->onlyOnIndex(),
            URL::make('Updating', fn () => config('app.url').'/susenas/monitoring/updating/monitoring.php')
                ->displayUsing(fn () => 'Excel Webmon'),
            URL::make('Pencacahan', fn () => config('app.url').'/susenas/monitoring/cacah/monitoring.php')
                ->displayUsing(fn () => 'Excel Webmon'),
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
