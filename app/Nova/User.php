<?php

namespace App\Nova;

use App\Helpers\Policy;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\PasswordConfirmation;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use ShuvroRoy\NovaTabs\Tabs;
use ShuvroRoy\NovaTabs\Traits\HasTabs;

class User extends Resource
{
    use HasTabs;

    public static function label()
    {
        return 'Pegawai';
    }

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

    public function subtitle()
    {
        return 'NIP. '.$this->nip;
    }

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
                Text::make('Username', 'email')
                    ->sortable()
                    ->rules('required', 'regex:/^[0-9A-Za-z.\-_]+$/u', 'max:254')
                    ->creationRules('unique:users,email')
                    ->updateRules('unique:users,email,{{resourceId}}')
                    ->readonly(Policy::make()->notAllowedFor('admin')->get()),
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
                    ->placeholder('NIP Baru')
                    ->creationRules('unique:users,nip')
                    ->updateRules('unique:users,nip,{{resourceId}}')
                    ->rules('required', 'size:18'),
                Text::make('NIP Lama', 'nip_lama')
                    ->placeholder('NIP Lama')
                    ->creationRules('unique:users,nip_lama')
                    ->updateRules('unique:users,nip_lama,{{resourceId}}')
                    ->rules('required', 'size:9'),
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

        ];
    }
}
