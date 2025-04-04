<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\ImportKodeArsip;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Tabs\Tab;

class TataNaskah extends Resource
{
    public static $with = ['kodeNaskah', 'kodeArsip', 'derajatNaskah', 'naskahDefault'];

    public static function label()
    {
        return 'Tata Naskah';
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\TataNaskah>
     */
    public static $model = \App\Models\TataNaskah::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nomor';

    public function subtitle()
    {
        return 'Tanggal: '.Helper::terbilangTanggal($this->tanggal);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nomor',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Nomor', 'nomor')
                ->sortable()
                ->rules('required', 'max:40'),
            Date::make('Tanggal', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required'),
            Tab::group('Detail Naskah', [
                HasMany::make('Format Penomoran Naskah', 'kodeNaskah', KodeNaskah::class),
                HasMany::make('Kode Arsip'),
                HasMany::make('Derajat Naskah'),
                HasMany::make('Naskah Default'),
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
        $actions = [];
        if (Policy::make()->allowedFor('admin')->get()) {
            $actions[] =
                ImportKodeArsip::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }

        return $actions;
    }
}
