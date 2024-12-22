<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Query\Search\SearchableText;

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
                    ->rules('required', 'before_or_equal:today', function ($attribute, $value, $fail) {
                        if (Helper::getYearFromDateString($value) != session('year')) {
                            return $fail('Tanggal harus di tahun yang telah dipilih');
                        }
                    })
                    ->filterable()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                Text::make('Tema')
                    ->sortable()
                    ->rules('required', 'max:80'),
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
