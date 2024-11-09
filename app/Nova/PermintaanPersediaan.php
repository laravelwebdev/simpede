<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\Download;
use App\Nova\Metrics\HelperPermintaanPersediaan;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PermintaanPersediaan extends Resource
{
    public static $with = ['daftarBarangPersediaans'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PermintaanPersediaan>
     */
    public static $model = \App\Models\PermintaanPersediaan::class;

    public static function label()
    {
        return 'Permintaan Persediaan';
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

    //BUG: belum ditentukan
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
        return [
            Date::make('Tanggal Permintaan', 'tanggal_permintaan')
                ->sortable()
                ->displayUsing(fn ($value) => Helper::terbilangTanggal($value))
                ->rules('required', 'before_or_equal:today')
                ->readonly(Policy::make()
                    ->allowedFor('bmn')
                    ->get()),
            Text::make('Untuk Kegiatan', 'kegiatan')
                ->rules('required')
                ->readonly(Policy::make()
                    ->allowedFor('bmn')
                    ->get()),
            Textarea::make('Catatan', 'keterangan')
                ->rules('required')
                ->alwaysShow()
                ->readonly(Policy::make()
                    ->allowedFor('bmn')
                    ->get()),
            Text::make('Pembuat', 'user_id')
                ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                ->exceptOnForms(),
            Date::make('Tanggal Persetujuan', 'tanggal_persetujuan')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('nullable', 'bail', 'after_or_equal:tanggal_permintaan')
                ->canSee(fn () => Policy::make()
                    ->allowedFor('bmn')
                    ->get()),
            Select::make('Pengelola Persediaan', 'pbmn_user_id')
                ->searchable()
                ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                ->dependsOn('tanggal_persetujuan', function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('bmn', Helper::createDateFromString($formData->tanggal_persetujuan)))
                        ->rules('required');
                })
                ->canSee(fn () => Policy::make()
                    ->allowedFor('bmn')
                    ->get()),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat'])
                ->failedWhen(['outdated']),
            MorphMany::make('Daftar Barang Persediaan', 'daftarBarangPersediaans', 'App\Nova\BarangPersediaan'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            HelperPermintaanPersediaan::make()
                ->width('full'),
        ];
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
        if (Policy::make()->allowedFor('bmn')->get()) {
            $actions[] =
            Download::make('bon', 'Unduh Permintaan Persediaan')
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Unduh');
        }

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal_permintaan', session('year'));
        if (Policy::make()->notAllowedFor('bmn')->get()) {
            $query->where('user_id', $request->user()->id);
        }
    }
}
