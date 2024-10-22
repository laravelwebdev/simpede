<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Nova\Filters\BulanKontrak;
use App\Nova\Filters\JenisKontrak;
use App\Nova\Metrics\JumlahKegiatan;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;

class RekapHonorMitra extends Lens
{
    public static $showPollingToggle = true;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

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
                'bulan,jenis_kontrak_id, nama,  mitra_id, count(DISTINCT jenis_kontrak_id) <=1 as valid_jumlah_kontrak, count(DISTINCT honor_kegiatan_id) as jumlah_kegiatan, sum(volume * harga_satuan) as nilai_kontrak, sum(volume * harga_satuan) < sbml as valid_sbml '
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
                ->groupBy(['bulan','mitra_id', 'nama', 'nik', 'sbml', 'jenis_kontrak_id'])
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
                ->displayUsing(fn ($value) => Helper::getPropertyFromCollection(Helper::getJenisKontrakById($value),'jenis'))
                ->readOnly(),
            Text::make('Bulan', 'bulan')
                ->displayUsing(fn ($value) => Helper::$bulan[$value])
                ->readOnly(),     
            Text::make('Nama', 'nama')
                ->readOnly(),
            Number::make('Jumlah Kegiatan', 'jumlah_kegiatan')
                ->readOnly(),
            Currency::make('Nilai Kontrak', 'nilai_kontrak')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Boolean::make('Sesuai SBML', 'valid_sbml')
                ->exceptOnForms(),
            Boolean::make('Jumlah Kontrak', 'valid_jumlah_kontrak')
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
            //TODO Jumlah kegiatan pakai value
            JumlahKegiatan::make(),
            //TODO Jumlah mitra pakai trends
            JumlahKegiatan::make(),
            // TODO honor per jenis kontrak pakai partition
            JumlahKegiatan::make(),
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
