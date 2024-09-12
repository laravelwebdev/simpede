<?php

namespace App\Nova;

use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\PasswordConfirmation;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use ShuvroRoy\NovaTabs\Tabs;
use ShuvroRoy\NovaTabs\Traits\HasTabs;

class User extends Resource
{
    use HasTabs;
    public static $with = ['unitKerja', 'pengelola'];

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
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Avatar::make('Avatar')->disableDownload()->disk('avatars')->prunable(),
            Panel::make('Akun', [
                Text::make('Email')
                    ->sortable()
                    ->rules('required', 'email', 'max:254')
                    ->creationRules('unique:users,email')
                    ->updateRules('unique:users,email,{{resourceId}}'),
                Password::make('Password')->onlyOnForms()
                    ->creationRules('required', Rules\Password::defaults(), 'confirmed')
                    ->updateRules('nullable', Rules\Password::defaults(), 'confirmed'),

                PasswordConfirmation::make('Password Confirmation'),
            ]),
            Panel::make('Biodata', [
                Text::make('Nama', 'name')
                    ->sortable()
                    ->rules('required'),
                Text::make('NIP')
                    ->placeholder('xxxxxxxx xxxxxx x xxxx')
                    ->rules('required'),
            ]),
            Tabs::make('Detail', [
                HasMany::make('Data Pegawai'),
                HasMany::make('Pengelola'),
            ]),

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
            // new DownloadExcel,
        ];
    }
}
