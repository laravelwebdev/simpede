<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\JenisNaskah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Query\Search\SearchableText;

class NaskahMasuk extends Resource
{
    public static $with = ['jenisNaskah'];

    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Naskah Masuk';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal', session('year'));
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\NaskahMasuk>
     */
    public static $model = \App\Models\NaskahMasuk::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->nomor;
    }

    public function subtitle()
    {
        return $this->perihal;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function searchableColumns()
    {
        return ['tanggal', new SearchableText('perihal'), 'nomor', 'pengirim'];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Date::make('Tanggal Naskah', 'tanggal')
                ->sortable()
                ->filterable()
                ->rules('required')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required', 'before_or_equal:today', function ($attribute, $value, $fail) {
                    if (Helper::getYearFromDateString($value) != session('year')) {
                        return $fail('Tanggal harus di tahun yang telah dipilih');
                    }
                }),
            Text::make('Nomor')
                ->rules('required')
                ->sortable(),
            Text::make('Pengirim')->rules('required'),
            Text::make('Perihal', 'perihal')->rules('required'),
            BelongsTo::make('Jenis Naskah')
                ->sortable()
                ->filterable()
                ->exceptOnForms(),
            Select::make('Jenis Naskah', 'jenis_naskah_id')
                ->rules('required')
                ->searchable()
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(JenisNaskah::cache()->get('all')->where('id', $kode)->first(), 'jenis'))
                ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $form) {
                    $field->options(Helper::setOptionsJenisNaskah($form->tanggal));
                }),
            File::make('Arsip')
                ->disk('naskah')
                ->rules('mimes:pdf')
                ->acceptedTypes('.pdf')
                ->creationRules('required')
                ->path(session('year').'/'.static::uriKey())
                ->storeAs(function (Request $request) {
                    $originalName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $request->file->getClientOriginalExtension();

                    return $originalName.'_'.uniqid().'.'.$extension;
                })
                ->prunable(),
        ];
    }

    /**
     * Get the fields displayed by the resource on index.
     *
     * @return array
     */
    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            Stack::make('Nomor/Tanggal', 'tanggal', [
                Line::make('Nomor', 'nomor')->asHeading(),
                Date::make('Tanggal Naskah', 'tanggal')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Pengirim')->rules('required'),
            Text::make('Perihal', 'perihal')->rules('required'),
            Select::make('Jenis Naskah', 'jenis_naskah_id')
                ->rules('required')
                ->searchable()
                ->onlyOnForms()
                ->displayUsingLabels()
                ->filterable()
                ->options(Helper::setOptions(JenisNaskah::cache()->get('all'), 'id', 'jenis')),
            $this->arsip ?
                URL::make('Arsip', fn () => Storage::disk('naskah')
                    ->url($this->arsip))
                    ->displayUsing(fn () => 'Lihat')
                    :
                Text::make('Arsip', fn () => '—'),
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
