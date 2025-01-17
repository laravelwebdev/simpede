<?php

namespace App\Nova;

use App\Helpers\Helper;
use Carbon\Carbon;
use DigitalCreative\Filepond\Filepond;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
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
    public static $title = 'user.name';

    public function subtitle()
    {
        return 'Tanggal: '.Helper::terbilangTanggal($this->tanggal).' Kegiatan: '.$this->kegiatan;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kegiatan', 'tanggal', 'user.name',
    ];

    public static $indexDefaultOrder = [
        'tanggal' => 'desc',
        'keluar' => 'desc',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];

            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }

        return $query->whereYear('tanggal', session('year'));
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Pegawai', 'user', User::class)
                ->filterable()
                ->sortable()
                ->exceptOnForms(),
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
                Time::make('Jam Kembali', 'kembali')
                    ->sortable()
                    ->hideWhenCreating()
                    ->updateRules('nullable', 'bail', 'after_or_equal:keluar'),
                Filepond::make('Bukti Dukung', 'bukti')
                    ->disk('izin_keluar')
                    ->disableCredits()
                    ->prunable()
                    ->image()
                    ->columns(3)
                    ->multiple()
                    ->dependsOn('kegiatan', function (Filepond $field, NovaRequest $request, FormData $formData) {
                        $field->path(session('year').'/'.Str::slug($formData->kegiatan));
                    })
                    ->hideWhenCreating(),
                Text::make('Bukti Dukung', fn () => $this->bukti ? count($this->bukti).' Foto' : null)
                    ->onlyOnIndex(),
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
