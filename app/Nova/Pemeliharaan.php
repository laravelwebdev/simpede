<?php

namespace App\Nova;

use App\Helpers\Helper;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Pemeliharaan extends Resource
{
    use Breadcrumbs;
    public static $group = 'Perekaman';

    public static function label()
    {
        return 'Pemeliharaan';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Pemeliharaan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nopol';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nopol', 'nama', 'jenis_pemeliharaan', 'tanggal',
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
            DynamicSelect::make('Nomor Polisi', 'nopol')
            ->options(
                DB::table('kendaraans')->select('nopol')->pluck('nopol', 'nopol')
            )
            ->rules('required')->sortable(),
            DynamicSelect::make('Nama Pemegang', 'nama')
            ->dependsOn(['nopol'])
            ->options(function ($values) {
                return DB::table('kendaraans')->select(['nama'])
                ->where('nopol', $values['nopol'])
                ->pluck('nama', 'nama');
            })
            ->default(function ($values) {
                if (! $values) {
                    return null;
                } else {
                    $nama = DB::table('kendaraans')->select('nama')
                    ->where('nopol', $values['nopol'])
                    ->value('nama');

                    return [
                        'label' => $nama,
                        'value' => $nama,
                    ];
                }
            })
            ->rules('required')->sortable(),
            DynamicSelect::make('Jenis Kendaraan', 'jenis')
            ->dependsOn(['nopol'])
            ->options(function ($values) {
                return DB::table('kendaraans')->select(['jenis'])
                ->where('nopol', $values['nopol'])
                ->pluck('jenis', 'jenis');
            })
            ->default(function ($values) {
                if (! $values) {
                    return null;
                } else {
                    $jenis = DB::table('kendaraans')->select('jenis')
                    ->where('nopol', $values['nopol'])
                    ->value('jenis');

                    return [
                        'label' => $jenis,
                        'value' => $jenis,
                    ];
                }
            })
            ->rules('required'),
            Select::make('Jenis Pemeliharaan', 'jenis_pemeliharaan')
                ->options(Helper::$jenis_pemeliharaan)
                ->rules('required'),
            Date::make('Tanggal Nota', 'tanggal')->rules('required')->sortable()->displayUsing(function ($tanggal) {
                return Helper::terbilangTanggal($tanggal);
            }),
            Currency::make('Jumlah', 'jumlah')
            ->currency('IDR')
            ->locale('id')
            ->rules('required'),
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
