<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserEksternal extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\UserEksternal>
     */
    public static $model = \App\Models\UserEksternal::class;

    public static function label()
    {
        return 'User Eksternal';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama';

    public function subtitle()
    {
        return $this->nik;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nik', 'nama',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('NIP/NIK', 'nik')
                ->onlyOnForms()
                ->updateRules('required', 'min:16', 'max:18', 'unique:user_eksternals,nik')
                ->creationRules('required', 'min:16', 'max:18', 'unique:user_eksternals,nik,{{resourceId}}'),
            Text::make('Nama', 'nama')
                ->sortable()
                ->showWhenPeeking()
                ->rules('required', 'max:255'),
            Select::make('Golongan')
                ->options(Helper::$golongan)
                ->searchable(),
            Text::make('Jabatan')
                ->rules('required', 'max:50'),
            Select::make('Bank', 'kode_bank_id')
                ->options(Helper::setOptionsKodeBank())
                ->displayUsingLabels(),
            Text::make('Nomor Rekening', 'rekening')
                ->showWhenPeeking()
                ->rules('nullable', 'bail', 'numeric', 'digits_between:5,20'),
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
