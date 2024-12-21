<?php

namespace App\Nova;

use App\Helpers\Helper;
use DigitalCreative\Filepond\Filepond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

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
        $imageFields = [];
        if ($this->file) {
            foreach ($this->file as $file) {
            $imageFields[] = Image::make('Foto', fn () => $file)
                ->disk('dokumentasi')
                ->disableDownload()
                ->onlyOnDetail();
            }
        }

        return array_merge([
            Date::make('Tanggal')
                ->rules('required', function ($attribute, $value, $fail) {
                    if (Helper::getYearFromDateString($value) != session('year')) {
                        return $fail('Tanggal harus di tahun yang telah dipilih');
                    }
                })
                ->displayUsing(fn ($value) => Helper::terbilangTanggal($value))
                ->sortable(),
            Text::make('Kegiatan')
                ->rules('required')
                ->sortable(),
            Filepond::make('Foto', 'file')
                ->disk('dokumentasi')
                ->disableCredits()
                ->prunable()
                ->columns(3)
                ->image()
                // ->onlyOnForms()
                ->multiple()
                ->rules('required')
                ->dependsOn('kegiatan', function (Filepond $field, NovaRequest $request, FormData $formData) {
                    $field->path(session('year').'/'.Str::slug($formData->kegiatan));
                }),
        ], $imageFields);
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
}
