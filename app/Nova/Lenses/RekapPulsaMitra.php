<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Nova\Actions\DetailPulsaMitra;
use App\Nova\Filters\BulanFilter;
use App\Nova\Metrics\JumlahKegiatan;
use App\Nova\Metrics\JumlahMitra;
use App\Nova\Metrics\KesesuaianSbml;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;
use Laravelwebdev\Numeric\Numeric;

class RekapPulsaMitra extends Lens
{
    public function name()
    {
        return 'Pulsa Mitra';
    }
    public static $showPollingToggle = true;

    public static $polling = true;

    public static $pollingInterval = 60;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['nama'];

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        $filtered_bulan = Helper::parseFilter($request->query->get('filters'), \App\Nova\Filters\BulanFilter::class, date('m'));

        return $request->withoutTableOrderPrefix()->withOrdering(
            $query->select('mitras.id', 'bulan', 'nama', 'mitra_id')
                ->selectRaw('count(DISTINCT pulsa_kegiatan_id) as jumlah_kegiatan, sum(harga) as nilai_pulsa, sum(harga) < `limit` as valid_limit, SUM(CASE WHEN harga > volume*sbml THEN 1 ELSE 0 END)=0 AS valid_limit_kegiatan')
                ->whereIn('pulsa_kegiatan_id', function ($query) use ($filtered_bulan) {
                    $query->select('id')->from('pulsa_kegiatans')
                        ->where('tahun', session('year'))
                        ->when(! empty($filtered_bulan), function ($query) use ($filtered_bulan) {
                            return $query->where('bulan', $filtered_bulan);
                        });
                })
                ->join('daftar_pulsa_mitras', 'mitras.id', '=', 'daftar_pulsa_mitras.mitra_id')
                ->join('pulsa_kegiatans', 'pulsa_kegiatans.id', '=', 'daftar_pulsa_mitras.pulsa_kegiatan_id')
                ->join('jenis_pulsas', 'jenis_pulsas.id', '=', 'pulsa_kegiatans.jenis_pulsa_id')
                ->join('limit_pulsas', 'limit_pulsas.id', '=', 'jenis_pulsas.limit_pulsa_id')
                ->groupBy('mitras.id', 'bulan', 'mitra_id', 'nama', 'limit'), fn ($query) => $query->orderBy('jenis_pulsa_id', 'asc')
                ->orderBy('bulan', 'desc')
                ->orderBy('nilai_pulsa', 'desc'));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan', 'bulan')
                ->displayUsingLabels()
                ->sortable()
                ->searchable()
                ->options(Helper::BULAN)
                ->readOnly(),
            Text::make('Nama', 'nama')
                ->sortable()
                ->readOnly(),
            Number::make('Jumlah Kegiatan', 'jumlah_kegiatan')
                ->readOnly()
                ->sortable(),
            Numeric::make('Nilai Pulsa', 'nilai_pulsa')
                ->readOnly()
                ->sortable(),
            Boolean::make('Limit Bulanan', 'valid_limit')
                ->exceptOnForms()
                ->sortable(),
            Boolean::make('Limit Kegiatan', 'valid_limit_kegiatan')
                ->exceptOnForms()
                ->sortable(),

        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            JumlahKegiatan::make('pulsa')
                ->help('Jumlah kegiatan yang membayar pulsa kepada mitra')
                ->refreshWhenFiltersChange(),
            JumlahMitra::make('pulsa')
                ->help('Jumlah mitra yang mendapat pulsa tiap bulan di semua kegiatan')
                ->refreshWhenFiltersChange(),
            KesesuaianSbml::make('pulsa')
                ->help('Jumlah Pulsa dengan nilai tidak melebihi batas limit bulanan')
                ->refreshWhenFiltersChange(),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            BulanFilter::make(),
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            DetailPulsaMitra::make()
                ->sole()
                ->onlyInline()
                ->withoutConfirmation(),
        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'rekap-pulsa-mitra';
    }
}
