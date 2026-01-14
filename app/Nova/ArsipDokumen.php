<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Filepond\Filepond;
use Laravelwebdev\Numeric\Numeric;

class ArsipDokumen extends Resource
{
    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Arsip Dokumen';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ArsipDokumen>
     */
    public static $model = \App\Models\ArsipDokumen::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'slug';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'slug',
    ];

    public static $globallySearchable = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $path = DB::table('kak_sp2d')
            ->where('id', $request->viaResourceId)
            ->value('kerangka_acuan_id');

        return [
            Text::make('Jenis Dokumen', 'slug')
                ->help('Tuliskan dengan Nomor Dokumen atau keterangan kegiatan jika tidak ada nomor. Misal: SPBy Nomor 123/XYZ/2024 atau Laporan Perjalanan Dinas Kegiatan ABC')
                ->rules('required', 'max:50'),
            Date::make('Tanggal Dokumen', 'tanggal_dokumen')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Numeric::make('Jumlah Halaman ', 'jumlah_halaman')
                ->rules('required', 'gt:0'),
            Filepond::make('File')
                ->disk('arsip')
                ->disableCredits()
                ->rules('required')
                ->mimesTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->path(session('year').'/'.static::uriKey().'/'.$path)
                ->dependsOn(
                    ['slug'],
                    function (File $field, NovaRequest $request, FormData $formData) {
                        $field->storeAs(function (Request $request) use ($formData) {
                            $originalName = Str::slug($formData->slug);
                            $extension = $request->file->getClientOriginalExtension();

                            return $originalName.'_'.uniqid().'.'.$extension;
                        });
                    }
                )
                ->prunable(),
            $this->file ?
            URL::make('Arsip', fn () => Storage::disk('arsip')
                ->url($this->file))
                ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                :
            Text::make('Arsip', fn () => null)->onlyOnIndex(),
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
        return [
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'kak_sp2ds'.'/';
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'kak_sp2ds'.'/';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->query('orderBy'))) {
            $query->getQuery()->orders = [];

            // Sort numerik
            $query->orderByRaw('id ASC');
        }

        return $query;
    }
}
