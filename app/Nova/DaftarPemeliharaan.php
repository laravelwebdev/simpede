<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class DaftarPemeliharaan extends Resource
{
    public static $with = ['masterBarangPemeliharaan', 'pemeliharaan'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarPemeliharaan>
     */
    public static $model = \App\Models\DaftarPemeliharaan::class;

    public static function label()
    {
        return 'Daftar Pemeliharaan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'masterBarangPemeliharaan.nama_barang';

    public function subtitle()
    {
        return $this->pemeliharaan->rincian;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'tanggal', 'uraian', 'pemeliharaan.rincian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Objek Pemeliharaan', 'masterBarangPemeliharaan', MasterBarangPemeliharaan::class)
                ->searchable()
                ->withSubtitles()
                ->rules('required'),
            Date::make('Tanggal Pemeliharaan', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required', function ($attribute, $value, $fail) {
                    if (Helper::getYearFromDateString($value) != session('year')) {
                        return $fail('Tanggal harus di tahun yang telah dipilih');
                    }
                }),
            Textarea::make('Keterangan Pemeliharaan', 'uraian')
                ->rules('required', 'max:255')
                ->help('Jelaskan detail pemeliharaan yang dilakukan secara lengkap. Misal: Pembelian BBM Pertamax 2 liter, Servis rutin dengan mengganti oli dan dan ganti busi')
                ->onlyonForms(),
            Text::make('Keterangan Pemeliharaan', 'uraian')
                ->exceptOnForms(),
            Text::make('Nama Penyedia', 'penyedia')
                ->rules('required', 'max:100'),
            Numeric::make('Biaya')
                ->rules('required', 'numeric', 'gt:0'),
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

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId;
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereYear('tanggal', session('year'));
    }
}
