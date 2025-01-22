<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Filepond\Filepond;
use Laravelwebdev\Repeatable\Repeatable;

class AnalisisSakip extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AnalisisSakip>
     */
    public static $model = \App\Models\AnalisisSakip::class;

    public static function label()
    {
        return 'Analisis SAKIP';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return 'Analisis SAKIP Bulan '.Helper::$bulan[$this->bulan];
    }

    public function subtitle()
    {
        return $this->tahun;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kegiatan', 'kendala', 'solusi', 'tindak_lanjut',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan', 'bulan')
                ->options(Helper::$bulan)
                ->displayUsingLabels()
                ->sortable()
                ->filterable()
                ->rules('required'),
            Select::make('Kategori')
                ->options(Helper::$kategori_sakip)
                ->displayUsingLabels()
                ->sortable()
                ->filterable()
                ->rules('required'),
            Text::make('Kegiatan')
                ->sortable()
                ->help('Misal: Survei Sosial Ekonomi Nasional Maret, Pengisian Metadata Statistik')
                ->rules('required'),
            Textarea::make('Kendala')
                ->rules('required'),
            Textarea::make('Solusi')
                ->rules('required'),
            Filepond::make('Bukti Dukung Pelaksanaan Solusi', 'bukti_solusi')
                ->disk('arsip')
                ->disableCredits()
                ->rules('required')
                ->columns(3)
                ->multiple()
                ->path(session('year').'/'.static::uriKey().'/'.$request->viaResourceId)
                ->prunable(),
            Panel::make('Tindak Lanjut', [
                Textarea::make('Tindak Lanjut')
                    ->hideWhenCreating(fn () => ! in_array(date('n'), [3, 6, 9, 12]))
                    ->hideWhenUpdating(fn () => ! in_array(date('n'), [3, 6, 9, 12])),
                Select::make('Bulan Deadline', 'bulan_deadline')
                    ->options(Helper::$bulan)
                    ->displayUsingLabels()
                    ->hideWhenCreating(fn () => ! in_array(date('n'), [3, 6, 9, 12]))
                    ->hideWhenUpdating(fn () => ! in_array(date('n'), [3, 6, 9, 12]))
                    ->readonly()
                    ->filterable(),
                Filepond::make('Bukti Tindak Lanjut', 'bukti_tl')
                    ->disk('arsip')
                    ->disableCredits()
                    ->columns(3)
                    ->hideWhenCreating(fn () => ! in_array(date('n'), [3, 6, 9, 12]))
                    ->hideWhenUpdating(fn () => ! in_array(date('n'), [3, 6, 9, 12]))
                    ->multiple()
                    ->path(session('year').'/'.static::uriKey().'/'.$request->viaResourceId)
                    ->prunable(),
                Repeatable::make('Penanggung Jawab', 'penanggung_jawab', [
                    Select::make('Nama', 'pj_user_id')
                        ->rules('required')
                        ->searchable()
                        ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                        ->options(Helper::setOptionPengelola('anggota', now())),

                ])->hideWhenCreating(fn () => ! in_array(date('n'), [3, 6, 9, 12]))
                    ->hideWhenUpdating(fn () => ! in_array(date('n'), [3, 6, 9, 12])),
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
