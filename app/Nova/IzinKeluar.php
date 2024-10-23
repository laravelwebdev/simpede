<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\User;
use Carbon\Carbon;
use Ctessier\NovaAdvancedImageField\AdvancedImage;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Oneduo\NovaTimeField\Time;

class IzinKeluar extends Resource
{
    public static $with = ['user'];

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
     * Build an "index" query for the given resource.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal', session('year'));
    }

    /**
     * Get the fields displayed by the resource.
     *
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
                ->rules('required', function ($attribute, $value, $fail) {
                    if (Carbon::createFromFormat('Y-m-d', $value)->year != session('year')) {
                        return $fail('Tanggal harus di tahun yang telah dipilih');
                    }
                })
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->filterable(),
            Time::make('Jam Keluar', 'keluar')
                ->rules('required'),
            Text::make('Kegiatan')
                ->rules('required'),
            Panel::make('Jam Kembali', [
                Time::make('Jam Kembali', 'kembali'),
                AdvancedImage::make('Bukti Dukung', 'bukti')
                    ->disk('izin_keluar')
                    ->croppable()
                    ->quality(60)
                    ->convert('webp')
                    ->prunable(),
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
}
