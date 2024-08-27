<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class HonorSurvei extends Resource
{
    public static $with = ['kerangkaAcuan'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\HonorSurvei>
     */
    public static $model = \App\Models\HonorSurvei::class;

    public static function label()
    {
        return 'SPJ Honor Survei';
    }

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
        'judul_spj', 'bulan',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Panel::make('Keterangan SPJ', [
                BelongsTo::make('Nomor KAK', 'kerangkaAcuan', 'App\Nova\KerangkaAcuan')
                    ->rules('required')
                    ->sortable()
                    ->readOnly()
                    ->hideWhenUpdating(),
                Text::make('Nama Survei', 'kegiatan')
                    ->rules('required')
                    ->sortable()
                    ->readOnly()
                    ->hideWhenUpdating(),
                Date::make('Batas Akhir Penyelesaian', 'akhir')
                    ->rules('required')
                    ->hideFromIndex()
                    ->readOnly()
                    ->hideWhenUpdating()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                Text::make('Judul SPJ', 'judul_spj')
                    ->rules('required')
                    ->sortable()
                    ->hideFromIndex(),
                Date::make('Tanggal SPJ', 'tanggal_spj')
                    ->rules('required')
                    ->hideFromIndex()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ]),
            Panel::make('Keterangan Kontrak', [
                Select::make('Bulan Kontrak', 'bulan')
                    ->rules('required')
                    ->options(Helper::$bulan)
                    ->filterable(),
                Select::make('Jenis Kontrak', 'jenis')
                    ->rules('required')
                    ->filterable()
                    ->options(Helper::$jenis_kontrak),
                Text::make('Satuan Pembayaran', 'satuan')
                    ->rules('required')
                    ->hideFromIndex()
                    ->help('Contoh Satuan Pembayaran: Dokumen, Ruta, BS'),
            ]),

            Panel::make('Keterangan Anggaran', [
                Text::make('MAK', 'mak')
                    ->readonly()
                    ->hideFromIndex(),
                Select::make('Detail', 'detail')
                    ->rules('required')
                    ->dependsOn('mak', function (Select $field, NovaRequest $request, FormData $form) {
                        $field->options(Helper::setOptions(Helper::getCollectionDetailAkun($form->mak), 'detail', 'detail'));
                    })
                    ->hideFromIndex(),
                Text::make('Tim Kerja', 'unit_kerja_id')
                    ->onlyOnIndex()
                    ->showOnIndex(fn (NovaRequest $request, $resource) => session('role') == 'ppk')
                    ->readOnly(),
            ]),

            // Link::make('Unduh', 'link')->text('Unduh')->onlyOnIndex(),

            // HasMany::make('SPjs','spjs'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
