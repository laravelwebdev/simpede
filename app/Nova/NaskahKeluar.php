<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\JenisNaskah;
use App\Models\KodeArsip;
use Carbon\Carbon;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

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
    public static $title = 'nomor';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nomor', 'tanggal', 'perihal', 'tujuan',
    ];

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
                ->rules('required', 'before_or_equal:today', function ($attribute, $value, $fail) {
                    if (Carbon::createFromFormat('Y-m-d', $value)->year != session('year')) {
                        return $fail('Tanggal harus di tahun berjalan');
                    }
                })
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->filterable(),
            Text::make('Nomor')
                ->onlyOnDetail(),
            Text::make('Tujuan', 'tujuan')
                ->rules('required'),
            Text::make('Perihal', 'perihal')
                ->rules('required'),
            Text::make('Dikirimkan melalui', 'pengiriman'),
            Date::make('Tanggal Kirim', 'tanggal_kirim')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('after_or_equal:tanggal'),
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
            Select::make('Jenis Naskah', 'jenis_naskah_id')
                ->rules('required')
                ->searchable()
                ->displayUsingLabels()
                ->filterable()
                ->options(Helper::setOptions(JenisNaskah::cache()->get('all'), 'id', 'jenis')),
            Stack::make('Pengiriman/Tanggal', [
                Line::make('Pengiriman', 'pengiriman')
                    ->asHeading(),
                Date::make('Tanggal Kirim', 'tanggal_kirim')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ]),
        ];
    }

    public function klasifikasiFields()
    {
        return [
            Select::make('Derajat Kerahasiaan', 'derajat')
                ->rules('required')
                ->displayUsingLabels()
                ->options([
                    'B' => 'Biasa',
                    'T' => 'Terbatas',
                    'R' => 'Rahasia',
                ]),
            Select::make('Klasifikasi Arsip', 'kode_arsip_id')
                ->rules('required')
                ->searchable()
                ->displayUsing(fn ($kode) => KodeArsip::cache()->get('all')->where('id', $kode)->first()->kode)
                ->options(Helper::setOptions(KodeArsip::cache()->get('all'), 'id', 'detail', 'group')),
            Select::make('Jenis Naskah', 'jenis_naskah_id')
                ->rules('required')
                ->searchable()
                ->displayUsingLabels()
                ->options(Helper::setOptions(JenisNaskah::cache()->get('all')->reject(function ($value) {
                    return $value->jenis == 'Form Permintaan';
                }), 'id', 'jenis')),
            Hidden::make('kode_naskah_id')
                ->dependsOn(['jenis_naskah_id'], function (Hidden $field, NovaRequest $request, FormData $form) {
                    $form->jenis_naskah_id == '' ? '' : $field->setValue(JenisNaskah::cache()->get('all')->where('id', $form->jenis_naskah_id)->first()->kode_naskah_id);
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
                ->prunable(),
            File::make('Signed')
                ->disk('naskah')
                ->rules('mimes:pdf')
                ->acceptedTypes('.pdf')
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
