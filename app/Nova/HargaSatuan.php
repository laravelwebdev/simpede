<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class HargaSatuan extends Resource
{
    public static function label()
    {
        return 'Harga Satuan Kegiatan';
    }

    public static $with = ['jenisKontrak'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\HargaSatuan>
     */
    public static $model = \App\Models\HargaSatuan::class;

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
            HasMany::make('Jenis Kontrak'),
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
