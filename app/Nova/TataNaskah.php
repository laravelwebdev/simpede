<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\ImportKodeArsip;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use ShuvroRoy\NovaTabs\Tabs;
use ShuvroRoy\NovaTabs\Traits\HasTabs;

class TataNaskah extends Resource
{
    use HasTabs;

    public static $with = ['kodeNaskah', 'kodeArsip', 'derajatNaskah'];

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
                ->rules('required'),
            Date::make('Tanggal', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required'),
            Tabs::make('Detail Naskah', [
                HasMany::make('Kode Naskah'),
                HasMany::make('Kode Arsip'),
                HasMany::make('Derajat Naskah'),
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
