<?php

namespace App\Nova;

use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Penyedia extends Resource
{
    use Breadcrumbs;
    public static $group = 'Referensi';

    public static function label()
    {
        return 'Penyedia';
    }

    public static function singularLabel()
    {
        return 'Penyedia';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Penyedia::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'penyedia';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'penyedia', 'nama_usaha',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            // ID::make(__('ID'), 'id')->sortable(),
            Text::make('Nama Penyedia', 'penyedia')
                ->placeholder('PT....')
                ->rules('required')->sortable(),
            Text::make('Nama Usaha', 'nama_usaha')
                ->rules('required')->sortable(),
            Text::make('Alamat', 'alamat')
                ->rules('required'),
            Text::make('NPWP', 'npwp'),
            Text::make('Rekening', 'rekening')
                ->placeholder('xxxxxxx atas nama'),
            Text::make('Bank', 'bank')
                ->placeholder('Bank ..... Cabang ....'),
            Text::make('Nama Penandatangan', 'penandatangan'),
            Text::make('Nomor Surat Kuasa', 'surat_kuasa'),
            Text::make('Kota Penyedia', 'kota')
                ->rules('required')->sortable(),
            Number::make('NIK Penyedia', 'nik')
                ->rules('nullable', 'digits:16'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
