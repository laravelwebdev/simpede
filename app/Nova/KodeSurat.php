<?php

namespace App\Nova;

use App\Nova\Actions\ImportKode;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class KodeSurat extends Resource
{
    use Breadcrumbs;
    public static $group = 'Referensi';

    public static function label()
    {
        return 'Kode Surat';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\KodeSurat::class;

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
        'k4',
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
            Text::make('Kode Surat', 'kode')->sortable()->rules('required'),
            Textarea::make('Klasifikasi 1', 'k1')->sortable()->rules('required')->showOnIndex()
            ->readMore(['max' => 255, 'mask' => '(...)']),
            Textarea::make('Klasifikasi 2', 'k2')->sortable()->rules('required')->showOnIndex()
            ->readMore(['max' => 255, 'mask' => '(...)']),
            Textarea::make('Klasifikasi 3', 'k3')->sortable()->rules('required')->showOnIndex()
            ->readMore(['max' => 255, 'mask' => '(...)']),
            Textarea::make('Klasifikasi 4', 'k4')->sortable()->rules('required')->showOnIndex()
            ->readMore(['max' => 255, 'mask' => '(...)']),
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
        if (Auth::user()->role == 'admin') {
            return [
                ImportKode::make()->standalone(),
            ];
        } else {
            return [];
        }
    }
}
