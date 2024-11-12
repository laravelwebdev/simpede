<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Nova\Metrics\JumlahKegiatan;
use App\Nova\Metrics\JumlahMitra;
use App\Nova\Metrics\KesesuaianSbml;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class RekapHonorMitra extends Lens
{
    public function name()
    {
        return 'Honor Mitra';
    }

    public static $showPollingToggle = true;

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
        return $request->withoutTableOrderPrefix()->withOrdering(
            $query->select('bulan', 'jenis_kontrak_id', 'nama', 'mitra_id')
                ->addSelect([
                    'jumlah_kegiatan' => fn ($query) => $query->selectRaw('count(DISTINCT honor_kegiatan_id)'),
                    'nilai_kontrak' => fn ($query) => $query->selectRaw('sum(volume_realisasi * harga_satuan)'),
                    'valid_sbml' => fn ($query) => $query->selectRaw('sum(volume_realisasi * harga_satuan) < sbml'),
                ])
                ->whereIn('honor_kegiatan_id', function ($query) use ($request) {
                    $request->withFilters($query->select('id')->from('honor_kegiatans')
                        ->where('tahun', session('year'))
                        ->where('jenis_honor', 'Kontrak Mitra Bulanan')
                    );
                })
                ->join('daftar_honor_mitras', 'mitras.id', '=', 'daftar_honor_mitras.mitra_id')
                ->join('honor_kegiatans', 'honor_kegiatans.id', '=', 'daftar_honor_mitras.honor_kegiatan_id')
                ->join('jenis_kontraks', 'jenis_kontraks.id', '=', 'honor_kegiatans.jenis_kontrak_id')
                ->groupBy(['bulan', 'mitra_id', 'nama', 'nik', 'sbml', 'jenis_kontrak_id'])
                ->orderBy('jenis_kontrak_id', 'asc')
                ->orderBy('bulan', 'desc')
                ->orderBy('nilai_kontrak', 'desc'));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Jenis Kontrak', 'jenis_kontrak_id')
                ->displayUsingLabels()
                ->sortable()
                ->options(Helper::setOptionJenisKontrak(now()))
                ->filterable()
                ->readOnly(),
            Select::make('Bulan', 'bulan')
                ->displayUsingLabels()
                ->sortable()
                ->options(Helper::$bulan)
                ->filterable()
                ->readOnly(),
            Text::make('Nama', 'nama')
                ->sortable()
                ->readOnly(),
            Number::make('Jumlah Kegiatan', 'jumlah_kegiatan')
                ->readOnly()
                ->sortable(),
            Currency::make('Nilai Kontrak', 'nilai_kontrak')
                ->readOnly()
                ->sortable(),
            Boolean::make('Sesuai SBML', 'valid_sbml')
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
            JumlahKegiatan::make()
                ->help('Jumlah kegiatan yang tertuang dalam kontrak bulanan mitra')
                ->refreshWhenFiltersChange(),
            JumlahMitra::make()
                ->help('Jumlah mitra yang berkontrak tiap bulan di semua kegiatan')
                ->refreshWhenFiltersChange(),
            KesesuaianSbml::make()
                ->help('Jumlah Kontrak dengan nilai tidak melebihi SBML')
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
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'rekap-honor-mitra';
    }
}
