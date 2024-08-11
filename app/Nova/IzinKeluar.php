<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\NaskahKeluar;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Oneduo\NovaTimeField\Time;

class IzinKeluar extends Resource
{
    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Izin Keluar';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\IzinKeluar>
     */
    public static $model = \App\Models\IzinKeluar::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kegiatan',
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
            Select::make('Pegawai', 'user_id')
                ->onlyOnIndex()
                ->filterable()
                ->searchable()
                ->displayUsingLabels()
                ->options(Helper::setOptions(User::cache()->get('all'), 'id', 'nama')),
            Date::make('Tanggal Keluar', 'tanggal')
                ->sortable()
                ->rules('required')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->filterable(),
            Time::make('Jam Keluar', 'keluar')
                ->rules('required'),                
            Text::make('Kegiatan')
                ->rules('required'),
            Panel::make('Jam Kembali', [
                Time::make('Jam Kembali', 'kembali'),
                Image::make('Bukti Dukung', 'bukti')
                    ->disk('izin_keluar'),
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
