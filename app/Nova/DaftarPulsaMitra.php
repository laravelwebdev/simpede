<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
use App\Nova\Actions\ImportDaftarPulsaMitra;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Filepond\Filepond;
use Laravelwebdev\Numeric\Numeric;

class DaftarPulsaMitra extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarPulsaMitra>
     */
    public static $model = \App\Models\DaftarPulsaMitra::class;

    public static $displayInNavigation = false;

    public static $with = ['pulsaKegiatan', 'mitra'];

    public static function label()
    {
        return 'Daftar Pulsa Mitra';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'mitra.nama';

    public function subtitle()
    {
        return 'Kegiatan: '.$this->pulsaKegiatan->kegiatan;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['mitra.nama', 'mitra.nik', 'pulsaKegiatan.kegiatan', 'pulsaKegiatan.bulan'];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        if ($request->viaResource === 'pulsa-kegiatans') {
            return [
                BelongsTo::make('Mitra', 'mitra', Mitra::class)
                    ->searchable()
                    ->readonly()
                    ->withSubtitles()
                    ->rules('required'),
                Number::make('Jumlah OJP/Kegiatan/dsb', 'volume')
                    ->rules('required', 'gt:0', 'lte:65535')
                    ->help('Isikan sesuai satuan misal 5 OJP, 1 Kegiatan'),
                Numeric::make('Nominal Pulsa', 'nominal')
                    ->rules('required', 'gt:0', 'lte:16777215'),
                Numeric::make('Harga Pulsa', 'harga')
                    ->rules('required', 'gt:0', 'lte:16777215'),
                Text::make('Handphone', 'mitra.no_pulsa')
                    ->onlyOnIndex(),
                Boolean::make('No HP Confirmed', 'confirmed')
                    ->readonly()
                    ->exceptOnForms(),
                Boolean::make('Sesuai Limit', fn () => $this->harga <= $this->volume * Helper::getLimitPulsaPerKegiatan($this->pulsaKegiatan->jenis_pulsa_id)),
                Filepond::make('Bukti Terima Pulsa', 'file')
                    ->disk('pulsa')
                    ->disableCredits()
                    ->image()
                    ->readonly()
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->file->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('koordinator,anggota')->get())
                    ->prunable(),
                Boolean::make('Bukti Terima', fn () => $this->file ? true : false),
            ];
        }
        if ($request->viaResource === 'mitras') {
            return [
                Text::make('Bulan', fn () => Helper::terbilangBulan($this->pulsaKegiatan->bulan))
                    ->filterable()
                    ->onlyOnIndex(),
                Number::make('Jumlah OJP/Kegiatan/dsb', 'volume')
                    ->onlyOnIndex(),
                Numeric::make('Nominal Pulsa', 'nominal')
                    ->onlyOnIndex(),
                Numeric::make('Harga Pulsa', 'harga')
                    ->onlyOnIndex(),
                Text::make('Handphone', 'handphone')
                    ->onlyOnIndex(),
                Boolean::make('No HP Confirmed', 'confirmed')
                    ->onlyOnIndex(),
                Boolean::make('Sesuai Limit', fn () => $this->harga <= $this->volume * Helper::getLimitPulsaPerKegiatan($this->pulsaKegiatan->jenis_pulsa_id))
                    ->onlyOnIndex(),
                Boolean::make('Bukti Terima', fn () => $this->file ? true : false)
                    ->onlyOnIndex(),
            ];
        }

        return [

        ];
    }

    public function fieldforAdd(NovaRequest $request)
    {
        return [
            Select::make('Mitra', 'mitra_id')
                ->options(Helper::setOptionsMitra(session('year')))
                ->searchable()
                ->rules('required')
                ->help('Pilih mitra yang akan ditambahkan'),
            Number::make('Jumlah OJP/Kegiatan/dsb', 'volume')
                ->rules('required', 'gt:0', 'lte:65535')
                ->help('Isikan sesuai satuan misal 5 OJP, 1 Kegiatan'),
            Numeric::make('Nominal Pulsa', 'nominal')
                ->rules('required', 'gt:0', 'lte:16777215'),
            Numeric::make('Harga Pulsa', 'harga')
                ->rules('required', 'gt:0', 'lte:16777215'),
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
        if ($request->viaResource === 'pulsa-kegiatans') {
            $actions[] = AddHasManyModel::make('DaftarPulsaMitra', 'PulsaKegiatan', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                ->size('5xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fieldforAdd($request));
        }
        if (Policy::make()->allowedFor('koordinator,anggota')->get() && $request->viaResourceId) {
            $actions[] =
                ImportDaftarPulsaMitra::make($request->viaResourceId)
                    ->standalone()
                    ->confirmButtonText('Import');
        }

        return $actions;
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId;
    }
}
