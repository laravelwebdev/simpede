<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Nova\Filters\BulanKontrak;
use App\Nova\Filters\JenisKontrak;
use App\Nova\Metrics\JumlahKegiatan;
use App\Nova\Metrics\JumlahMitra;
use App\Nova\Metrics\KesesuaianSbml;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class RekapBarangPersediaan extends Lens
{
    public static $showPollingToggle = true;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['barang', 'kode'];

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering(
            $query->selectRaw(
                'bulan,jenis_kontrak_id, nama,  mitra_id, count(DISTINCT honor_kegiatan_id) as jumlah_kegiatan, sum(volume_realisasi * harga_satuan) as nilai_kontrak, sum(volume_realisasi * harga_satuan) < sbml as valid_sbml '
            )
                ->whereIn('honor_kegiatan_id', function ($query) use ($request) {
                    $request->withFilters($query->select('id')->from('honor_kegiatans')
                        ->where('tahun', session('year'))
                        ->where('jenis_honor', 'Kontrak Mitra Bulanan')
                    );
                })
                ->join('honor_kegiatans', 'honor_kegiatans.id', '=', 'daftar_honor_mitras.honor_kegiatan_id')
                ->join('jenis_kontraks', 'jenis_kontraks.id', '=', 'honor_kegiatans.jenis_kontrak_id')
                ->join('mitras', 'mitras.id', '=', 'daftar_honor_mitras.mitra_id')
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
            Text::make('Jenis Kontrak', 'jenis_kontrak_id')
                ->displayUsing(fn ($value) => Helper::getPropertyFromCollection(Helper::getJenisKontrakById($value), 'jenis'))
                ->readOnly(),
            Text::make('Bulan', 'bulan')
                ->displayUsing(fn ($value) => Helper::$bulan[$value])
                ->readOnly(),
            Text::make('Nama', 'nama')
                ->readOnly(),
            Number::make('Jumlah Kegiatan', 'jumlah_kegiatan')
                ->readOnly(),
            Currency::make('Nilai Kontrak', 'nilai_kontrak')

                ->readOnly(),
            Boolean::make('Sesuai SBML', 'valid_sbml')
                ->exceptOnForms(),

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
            JenisKontrak::make(),
            BulanKontrak::make(),
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
