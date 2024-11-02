<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\Download;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarKontrakMitra extends Resource
{
    public static $displayInNavigation = false;

    public static $with = ['kontrakNaskahKeluar', 'bastNaskahKeluar', 'daftarHonorMitra'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarKontrakMitra>
     */
    public static $model = \App\Models\DaftarKontrakMitra::class;

    public static function label()
    {
        return 'Daftar Kontrak Mitra';
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
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $mitra = Helper::getMitraById($this->mitra_id);

        return [
            Text::make('NIK', fn () => Helper::getPropertyFromCollection($mitra, 'nik'))
                ->readOnly()->hideFromIndex(),
            Text::make('Nama', fn () => Helper::getPropertyFromCollection($mitra, 'nama'))
                ->readOnly(),
            BelongsTo::make('Nomor Kontrak', 'kontrakNaskahKeluar', 'App\Nova\NaskahKeluar')
                ->readOnly()
                ->noPeeking(),
            BelongsTo::make('Nomor BAST', 'bastNaskahKeluar', 'App\Nova\NaskahKeluar')
                ->readOnly()
                ->noPeeking(),
            Number::make('Jumlah Kegiatan', 'jumlah_kegiatan')
                ->readOnly(),
            Currency::make('Nilai Kontrak')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Status::make('Kontrak', 'status_kontrak')
                ->loadingWhen(['dibuat', 'diupdate'])
                ->failedWhen(['outdated'])
                ->onlyOnIndex(),
            Status::make('BAST', 'status_bast')
                ->loadingWhen(['dibuat', 'diupdate'])
                ->failedWhen(['outdated'])
                ->onlyOnIndex(),
            Boolean::make('Sesuai SBML', 'valid_sbml')
                ->exceptOnForms(),
            Boolean::make('Jumlah Kontrak', 'valid_jumlah_kontrak')
                ->exceptOnForms(),
            HasMany::make('Daftar Honor Mitra'),
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
        $actions = [];
        if (Policy::make()->allowedFor('ppk')->get()) {
            $actions[] =
                Download::make('kontrak', 'Unduh Kontrak')
                    ->showInline()
                    ->showOnDetail()
                    ->confirmButtonText('Unduh');
            $actions[] =
                Download::make('bast', 'Unduh BAST')
                    ->showInline()
                    ->showOnDetail()
                    ->confirmButtonText('Unduh');
        }

        return $actions;
    }
}
