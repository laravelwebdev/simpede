<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\UnitKerja;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class User extends Resource
{
    public static $with = ['unitKerja'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nama', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Avatar::make('Avatar')->disableDownload()->disk('avatars'),
            Panel::make('Akun', [
                Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),      
            ]),
            Panel::make('Biodata', [
            Text::make('Nama')
                ->sortable()
                ->rules('required'),
            Text::make('NIP')
                ->placeholder('xxxxxxxx xxxxxx x xxxx')
                ->rules('required'),
            Select::make('Golongan')
                ->options(Helper::$golongan)
                ->rules('required')
                ->searchable(),
            Text::make('Pangkat')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            Text::make('Jabatan')
                ->rules('required'),
            BelongsTo::make('Unit Kerja')
                ->filterable()
                ->rules('required'),
            Select::make('Role')
                ->options(Helper::$role)
                ->rules('required')
                ->filterable(),   
            ]),       
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
