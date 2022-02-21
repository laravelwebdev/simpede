<?php

namespace App\Nova;

use App\Helpers\Helper;
use ChrisWare\NovaBreadcrumbs\Traits\Breadcrumbs;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use OwenMelbz\RadioField\RadioButton;

class Surat extends Resource
{
    use Breadcrumbs;
    public static $group = 'Referensi';

    public static function label()
    {
        return 'Surat Keluar';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Surat::class;

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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Nomor', 'nomor')
                ->hideWhenCreating()
                ->readonly(function ($request) {
                    return $request->isUpdateOrUpdateAttachedRequest();
                })->sortable()
                ->rules('required'),
            new Panel('Klasifikasi Surat', $this->klasifikasiFields()),
            Date::make('Tanggal Surat', 'tanggal')
                ->readonly(function ($request) {
                    return $request->isUpdateOrUpdateAttachedRequest();
                })->sortable()
                ->rules('required')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Text::make('Tujuan', 'tujuan')
                ->placeholder('Penerima surat')
                ->rules('required'),
            Textarea::make('Perihal', 'perihal')
                ->placeholder('Perihal surat')
                ->rules('required')->alwaysShow(),
            Text::make('Dikirimkan melalui', 'pengiriman'),
            Date::make('Tanggal Kirim', 'kirim')->displayUsing(function ($tanggal) {
                return Helper::terbilangTanggal($tanggal);
            }),
        ];
    }

    /**
     * Get the fields displayed by the resource on index page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fieldsForIndex(Request $request)
    {
        return [
            // ID::make(__('ID'), 'id')->sortable(),
            Stack::make('Nomor/Tanggal', [
                Line::make('Nomor', 'nomor')->asHeading(),
                Date::make('Tanggal Permintaan', 'tanggal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            ]),
            Text::make('Jenis Surat', 'jenis'),
            Text::make('Tujuan'),
            Textarea::make('Perihal')
                ->showOnIndex()
                ->readMore(['max' => 255, 'mask' => '(...)']),
            Stack::make('Pengiriman/Tanggal', [
                Line::make('Pengiriman', 'pengiriman')->asHeading(),
                Date::make('Tanggal Kirim', 'kirim')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            ]),
        ];
    }

    public function klasifikasiFields()
    {
        return[
            RadioButton::make('Jenis Surat', 'jenis')
            ->options(Helper::$jenis_surat)
            ->default('Surat Biasa'),
            DynamicSelect::make('Klasifikasi 1', 'k1')
            ->options(
                DB::table('kode_surats')->select('k1')->pluck('k1', 'k1')
            )
            ->rules('required')->sortable(),
            DynamicSelect::make('Klasifikasi 2', 'k2')
            ->dependsOn(['k1'])
            ->options(function ($values) {
                return DB::table('kode_surats')->select(['k2'])
                ->where('k1', $values['k1'])
                ->pluck('k2', 'k2');
            })->rules('required')->sortable(),
            DynamicSelect::make('Klasifikasi 3', 'k3')
            ->dependsOn(['k1', 'k2'])
            ->options(function ($values) {
                return DB::table('kode_surats')->select(['k3'])
                ->where('k2', $values['k2'])
                ->where('k1', $values['k1'])
                ->pluck('k3', 'k3');
            })->rules('required')->sortable(),
            DynamicSelect::make('Klasifikasi 4', 'k4')
            ->dependsOn(['k1', 'k3'])
            ->options(function ($values) {
                return DB::table('kode_surats')->select(['k4', 'id'])
                ->where('k3', $values['k3'])
                ->where('k1', $values['k1'])
                ->pluck('k4', 'id');
            })->rules('required')->sortable(),

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
