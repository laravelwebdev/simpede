<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Nova\Actions\Download;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Numeric\Numeric;
use Laravelwebdev\Repeatable\Repeatable;

class DaftarPesertaPerjalanan extends Resource
{
    public static $with = ['user', 'perjalananDinas', 'asalMasterWilayah'];

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

    public function subtitle()
    {
        return $this->perjalananDinas->uraian;
    }

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
                ->updateRules('required', Rule::unique('daftar_peserta_perjalanans', 'user_id')->where('perjalanan_dinas_id', $request->viaResourceId)->ignore($this->id))
                ->creationRules('required', Rule::unique('daftar_peserta_perjalanans', 'user_id')->where('perjalanan_dinas_id', $request->viaResourceId)),
            BelongsTo::make('Asal', 'asalMasterWilayah', MasterWilayah::class)
                ->searchable()
                ->rules('required'),
            Select::make('Angkutan')
                ->searchable()
                ->rules('required')
                ->options(Helper::$jenis_angkutan)
                ->displayUsingLabels(),
            Repeatable::make('Item Biaya', 'spesifikasi', [
                Text::make('Item', 'item')
                    ->help('Misal: Uang Harian, Penginapan, Transportasi, dll')
                    ->rules('required', 'max:255'),
                Number::make('Jumlah', 'jumlah')
                    ->step(1)
                    ->rules('required', 'integer', 'gt:0'),
                Text::make('Satuan', 'satuan')
                    ->help('Misal: O-H, malam, O-P, dll')
                    ->rules('required', 'max:40'),
                Numeric::make('Harga Satuan', 'harga_satuan')
                    ->rules('required', 'integer', 'gt:0'),
            ]),

            Panel::make('Keterangan Kuitansi', [
                Date::make('Tanggal Kuitansi', 'tanggal_kuitansi')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->default(now())
                    ->rules('required'),
                Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn('tanggal_kuitansi', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field
                            ->rules('required')
                            ->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal_kuitansi)))
                            ->default(Helper::setDefaultPengelola('ppk', Helper::createDateFromString($formData->tanggal_kuitansi)));
                    }),
                Select::make('Bendahara', 'bendahara_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn('tanggal_kuitansi', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field
                            ->options(Helper::setOptionPengelola('bendahara', Helper::createDateFromString($formData->tanggal_kuitansi)))
                            ->rules('required')
                            ->default(Helper::setDefaultPengelola('bendahara', Helper::createDateFromString($formData->tanggal_kuitansi)));
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
        return [
            Download::make('sppd', 'Unduh Surat Tugas dan SPPD')
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Unduh'),
            Download::make('pernyataan_kendaraan', 'Unduh Pernyataan Kendaraan')
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && ($this->resource->angkutan !== 'Kendaraan Dinas');
                })
                ->confirmButtonText('Unduh'),
            Download::make('kuitansi', 'Unduh Kuitansi Perjalanan')
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Unduh'),
        ];
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'perjalanan-dinas'.'/';
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'perjalanan-dinas'.'/';
    }
}
