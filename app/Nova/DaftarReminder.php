<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarReminder extends Resource
{
    public static $with = ['daftarKegiatan'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarReminder>
     */
    public static $model = \App\Models\DaftarReminder::class;

    public static function label()
    {
        return 'Daftar Reminder';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'daftarKegiatan.kegiatan';

    public function subtitle()
    {
        return Helper::terbilangTanggal($this->tanggal);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'tanggal', 'daftarKegiatan.kegiatan', 'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Date::make('Tanggal')
                ->displayUsing(function ($value) {
                    return Helper::terbilangTanggal($value);
                })
                ->sortable(),
            BelongsTo::make('Daftar Kegiatan'),
            Text::make('Status')->exceptOnForms(),
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
            Action::using('Kirim Sekarang', function (ActionFields $fields, Collection $models) {
                $reminder = $models->first();
                Helper::sendReminder($reminder, 'manual');
            })
                ->sole()
                ->canSee(fn () => $this->resource->status !== 'sent'),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereYear('tanggal', session('year'));
    }
}
