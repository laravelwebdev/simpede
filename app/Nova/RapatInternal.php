<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Query\Search\SearchableText;
use Oneduo\NovaTimeField\Time;

class RapatInternal extends Resource
{
    public static $with = ['kasubbag', 'pimpinan', 'kepala', 'notulis', 'naskahKeluar'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RapatInternal>
     */
    public static $model = \App\Models\RapatInternal::class;

    public static function label()
    {
        return 'Rapat Internal';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return Helper::terbilangTanggal($this->tanggal_rapat);
    }

    public function subtitle()
    {
        return $this->tema;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function searchableColumns()
    {
        return ['naskahKeluar.nomor', 'tanggal', 'tema',  new SearchableText('agenda')];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Panel::make('Keterangan Rapat', [
                Date::make('Tanggal Rapat')
                    ->sortable()
                    ->rules('required', function ($attribute, $value, $fail) {
                        if (Helper::getYearFromDateString($value) != session('year')) {
                            return $fail('Tanggal harus di tahun yang telah dipilih');
                        }
                    })
                    ->filterable()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                Text::make('Tema')
                    ->default('Rapat ')
                    ->help('Diawali dengan kata Rapat, contoh: Rapat Bulanan Pegawai Bulan Januari 2024')
                    ->rules('required', 'max:80'),
            ]),
            Panel::make('Undangan', [
                Date::make('Tanggal')
                    ->hideFromIndex()
                    ->rules('required', 'before_or_equal:today', 'before_or_equal:tanggal_rapat')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                BelongsTo::make('Nomor', 'naskahKeluar', 'App\Nova\naskahKeluar')
                    ->onlyOnDetail(),
                Text::make('Tujuan')
                    ->hideFromIndex()
                    ->default('Seluruh Pegawai BPS Kabupaten Hulu Sungai Tengah')
                    ->rules('required', 'max:80'),
                Text::make('Tempat')
                    ->hideFromIndex()
                    ->default('Aula BPS Kabupaten Hulu Sungai Tengah')
                    ->rules('required', 'max:80'),
                Time::make('Jam Mulai', 'mulai')
                    ->hideFromIndex()
                    ->rules('required'),
                Textarea::make('Agenda')
                    ->rules('required')
                    ->alwaysShow(),
                BelongsTo::make('Kepala', 'kepala', 'App\Nova\User')
                    ->hideFromIndex()
                    ->rules('required'),
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
        return [];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereYear('tanggal_rapat', session('year'));
    }
}
