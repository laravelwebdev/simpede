<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\DokumentasiKegiatan as ModelsDokumentasiKegiatan;
use App\Nova\Metrics\MetricTrend;
use App\Nova\Metrics\MetricValue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Filepond\Filepond;

class DokumentasiKegiatan extends Resource
{
    public static $with = ['user'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DokumentasiKegiatan>
     */
    public static $model = \App\Models\DokumentasiKegiatan::class;

    public static function label()
    {
        return 'Foto Kegiatan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return Helper::terbilangTanggal($this->tanggal);
    }

    public function subtitle()
    {
        return $this->kegiatan;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'tanggal', 'kegiatan',
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
                ->rules('required', function ($attribute, $value, $fail) {
                    if (Helper::getYearFromDateString($value) != session('year')) {
                        return $fail('Tanggal harus di tahun yang telah dipilih');
                    }
                })
                ->filterable()
                ->displayUsing(fn ($value) => Helper::terbilangTanggal($value))
                ->sortable(),
            Text::make('Kegiatan')
                ->rules('required', 'max:255')
                ->sortable(),
            Boolean::make('Original Size', 'uncompress')
                ->default(false)
                ->onlyOnForms()
                ->help('Untuk menghemat penyimpanan, gambar akan dikompres, centang pilihan ini hanya jika diperlukan foto tanpa dikompres')
                ->rules('required'),
            Filepond::make('Foto', 'file')
                ->disk('dokumentasi')
                ->disableCredits()
                ->prunable()
                ->columns(3)
                ->limit(10)
                ->image()
                ->help('Jika lebih dari 10 foto, silakan buat part dokumentasi baru')
                ->multiple()
                ->rules('required')
                ->dependsOn('kegiatan', function (Filepond $field, NovaRequest $request, FormData $formData) {
                    $field->path(session('year').'/'.Str::slug($formData->kegiatan));
                }),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsDokumentasiKegiatan::whereYear('tanggal', session('year'));

        return [
            MetricValue::make($model, 'total-dokumentasi')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricTrend::make($model, 'tanggal', 'trend-dokumentasi')
                ->refreshWhenActionsRun()
                ->width('1/2'),
        ];
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

    public static $indexDefaultOrder = [
        'tanggal' => 'desc',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->query('orderBy'))) {
            $query->getQuery()->orders = [];

            $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }

        return $query->whereYear('tanggal', session('year'));
    }
}
