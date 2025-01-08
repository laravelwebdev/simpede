<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\EditRekening;
use App\Nova\Actions\ImportDaftarHonorMitra;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class DaftarHonorMitra extends Resource
{
    public static $displayInNavigation = false;

    public static $with = ['honorKegiatan', 'mitra'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarHonorMitra>
     */
    public static $model = \App\Models\DaftarHonorMitra::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'mitra.nama';

    public function subtitle()
    {
        return 'Kegiatan: '.$this->honorKegiatan->kegiatan;
    }

    public static $search =
        ['mitra.nama', 'mitra.nik'];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $kegiatan = $this->honorKegiatan;
        if ($request->viaResource === 'honor-kegiatans') {
            return [
                BelongsTo::make('Mitra')
                    ->onlyOnIndex(),
                Number::make('Target', 'volume_target')
                    ->rules('required', 'gt:0')
                    ->step(0.01),
                Number::make('Realisasi', 'volume_realisasi')
                    ->rules('required', 'gt:0')
                    ->step(0.01),
                Status::make('Status', 'status_realisasi')
                    ->loadingWhen(['Loading'])
                    ->failedWhen(['Selesai Tidak Sesuai Target'])
                    ->onlyOnIndex(),
                Numeric::make('Harga Satuan', 'harga_satuan')
                    ->rules('required', 'gt:0'),
                Numeric::make('Bruto', fn () => $this->volume_realisasi * $this->harga_satuan)
                    ->onlyOnIndex(),
                Number::make('Persentase Pajak', 'persen_pajak')
                    ->onlyOnForms()
                    ->rules('nullable', 'bail', 'gte:0', 'lte:100')
                    ->step(0.01),
                Numeric::make('Pajak', fn () => round($this->volume_realisasi * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
                    ->onlyOnIndex(),
                Numeric::make('Netto', fn () => $this->volume_realisasi * $this->harga_satuan - round($this->volume_realisasi * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
                    ->onlyOnIndex(),
                Select::make('Bank', 'mitra.kode_bank_id')
                    ->options(Helper::setOptionsKodeBank())
                    ->displayUsingLabels()
                    ->onlyOnIndex(),
                Text::make('Rekening', 'mitra.rekening')
                    ->onlyOnIndex(),
            ];
        }

        return [
            Text::make('Kegiatan', fn () => $kegiatan->kegiatan)
                ->onlyOnIndex(),
            Number::make('Target', 'volume_target')
                ->onlyOnIndex(),
            Number::make('Realisasi', 'volume_realisasi')
                ->onlyOnIndex(),
            Status::make('Status', 'status_realisasi')
                ->loadingWhen(['Loading'])
                ->failedWhen(['Selesai Tidak Sesuai Target']),
            Numeric::make('Harga Satuan', 'harga_satuan')
                ->onlyOnIndex(),
            Numeric::make('Bruto', fn () => $this->volume_realisasi * $this->harga_satuan)
                ->onlyOnIndex(),
            Numeric::make('Pajak', fn () => round($this->volume_realisasi * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
                ->onlyOnIndex(),
            Numeric::make('Netto', fn () => $this->volume_realisasi * $this->harga_satuan - round($this->volume_realisasi * $this->harga_satuan * $this->persen_pajak / 100, 0, PHP_ROUND_HALF_UP))
                ->onlyOnIndex(),
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
        return [

        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if ($request->viaResource === 'honor-kegiatans') {
            if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
                $actions[] =
                    EditRekening::make('mitra')->onlyInline();
            }
            if (Policy::make()->allowedFor('koordinator,anggota')->get() && $request->viaResourceId) {
                $actions[] =
                    ImportDaftarHonorMitra::make($request->viaResourceId)
                        ->standalone()
                        ->confirmButtonText('Import');
            }
        }

        return $actions;
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Daftar%20Honor=daftar-honor-mitra';
    }
}
