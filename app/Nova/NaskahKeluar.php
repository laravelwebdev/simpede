<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\DerajatNaskah;
use App\Models\JenisNaskah;
use App\Models\KodeArsip;
use App\Nova\Filters\GenerateNaskah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Query\Search\SearchableText;

class NaskahKeluar extends Resource
{
    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Naskah Keluar';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal', session('year'));
    }

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\NaskahKeluar>
     */
    public static $model = \App\Models\NaskahKeluar::class;

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
        return ['tanggal', new SearchableText('perihal'), 'nomor', 'tujuan'];
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
                ->rules('required', 'before_or_equal:today')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required', 'before_or_equal:today', function ($attribute, $value, $fail) {
                    if (Helper::getYearFromDateString($value) != session('year')) {
                        return $fail('Tanggal harus di tahun yang telah dipilih');
                    }
                }),
            Text::make('Nomor')
                ->onlyOnDetail(),
            Text::make('Tujuan', 'tujuan')
                ->rules('required'),
            Text::make('Perihal', 'perihal')
                ->rules('required'),
            Text::make('Dikirimkan melalui', 'pengiriman'),
            Date::make('Tanggal Kirim', 'tanggal_kirim')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('nullable', 'bail', 'after_or_equal:tanggal'),
            new Panel('Klasifikasi Surat', $this->klasifikasiFields()),
            new Panel('Arsip', $this->arsipFields()),
        ];
    }

    /**
     * Get the fields displayed by the resource on index page.
     *
     * @return array
     */
    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            Stack::make('Nomor/Tanggal', 'tanggal', [
                Line::make('Nomor', 'nomor')
                    ->asHeading(),
                Date::make('Tanggal Naskah', 'tanggal')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Text::make('Tujuan'),
            Text::make('Perihal', 'perihal'),
            Stack::make('Pengiriman/Tanggal', 'tanggal_kirim', [
                Line::make('Pengiriman', 'pengiriman')
                    ->asHeading(),
                Date::make('Tanggal Kirim', 'tanggal_kirim')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Badge::make('Pembuatan', 'generate')->map([
                'M' => 'info',
                'A' => 'success',
            ])
                ->sortable(),
            $this->signed ?
            URL::make('Arsip', fn () => Storage::disk('naskah')
                ->url($this->signed))
                ->displayUsing(fn () => 'Lihat')
                :
            Text::make('Arsip', fn () => '—'),
        ];
    }

    public function klasifikasiFields()
    {
        return [
            Select::make('Derajat Kerahasiaan', 'derajat_naskah_id')
                ->rules('required')
                ->searchable()
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(DerajatNaskah::cache()->get('all')->where('id', $kode)->first(), 'derajat'))
                ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $form) {
                    $field->options(Helper::setOptionsDerajatNaskah($form->tanggal));
                }),
            Select::make('Klasifikasi Arsip', 'kode_arsip_id')
                ->rules('required')
                ->searchable()
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $form) {
                    $field->options(Helper::setOptionsKodeArsip($form->tanggal));
                }),
            Select::make('Jenis Naskah', 'jenis_naskah_id')
                ->rules('required')
                ->searchable()
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(JenisNaskah::cache()->get('all')->where('id', $kode)->first(), 'jenis'))
                ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $form) {
                    $field->options(Helper::setOptionsJenisNaskah($form->tanggal));
                }),
        ];
    }

    public function arsipFields()
    {
        return [
            File::make('Draft')
                ->disk('naskah')
                ->rules('mimes:docx')
                ->acceptedTypes('.docx')
                ->path(session('year').'/'.static::uriKey().'/draft')
                ->storeAs(function (Request $request) {
                    $originalName = pathinfo($request->draft->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $request->draft->getClientOriginalExtension();

                    return $originalName.'_'.uniqid().'.'.$extension;
                })
                ->hideWhenCreating()
                ->prunable(),
            File::make('Signed')
                ->disk('naskah')
                ->rules('mimes:pdf')
                ->acceptedTypes('.pdf')
                ->path(session('year').'/'.static::uriKey().'/signed')
                ->storeAs(function (Request $request) {
                    $originalName = pathinfo($request->signed->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $request->signed->getClientOriginalExtension();

                    return $originalName.'_'.uniqid().'.'.$extension;
                })
                ->hideWhenCreating()
                ->prunable(),
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
        return [
            GenerateNaskah::make(),
        ];
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

    public function replicate()
    {
        return tap(parent::replicate(), function ($resource) {
            $model = $resource->model();
            $model->tanggal = null;
        });
    }
}
