<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Nova\Repeater\SpesifikasiPerjalananDinas;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class DaftarPesertaPerjalanan extends Resource
{
    public static $with = ['user', 'perjalananDinas'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarPesertaPerjalanan>
     */
    public static $model = \App\Models\DaftarPesertaPerjalanan::class;

    public static function label()
    {
        return 'Daftar Peserta Perjalanan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'user.name';

    public static $subtitle = 'perjalananDinas.uraian';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'user.name', 'perjalananDinas.uraian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Nama', 'user', User::class)
                ->searchable()
                ->withSubtitles()
                ->rules('required'),
            Text::make('Berangkat Dari:', 'asal')
                ->rules('required'),
            Text::make('Tujuan:', 'tujuan')
                ->rules('required'),
            Select::make('Angkutan')
                ->rules('required')
                ->options(Helper::$jenis_angkutan)
                ->displayUsingLabels(),
            SpesifikasiPerjalananDinas::make('Spesifikasi', 'spesifikasi')
                ->confirmRemoval(),
            Panel::make('Keterangan Kuitansi', [
                Date::make('Tanggal Kuitansi', 'tanggal_kuitansi')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->default(now())
                    ->rules('required'),
                Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_kuitansi', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field
                            ->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal_kuitansi)));

                    }),
                Select::make('Bendahara', 'bendahara_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_kuitansi', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field
                            ->options(Helper::setOptionPengelola('bendahara', Helper::createDateFromString($formData->tanggal_kuitansi)));

                    }),
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
