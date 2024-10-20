<?php

namespace App\Nova\Lenses;

use App\Helpers\Helper;
use App\Models\HonorKegiatan;
use App\Models\KontrakMitra;
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
    private static $bulan;
    private static $tahun;
    private static $jenis_kontrak;

    public function __construct($bulan = null, $tahun = null, $jenis_kontrak=null)
    {
        self::$bulan = $bulan;
        self::$tahun = $tahun;
        self::$jenis_kontrak = $jenis_kontrak;
    }

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
        $honorKegiatanIds = HonorKegiatan::where('bulan', self::$bulan)
            ->where('tahun', self::$tahun)
            ->where('jenis_kontrak', self::$jenis_kontrak)
            ->where('jenis_honor', 'Kontrak Mitra Bulanan')
            ->get()
            ->pluck('id');
        $sbml = Helper::getPropertyFromCollection(Helper::getJenisKontrakById(self::$jenis_kontrak), 'sbml');

        return $request->withOrdering($request->withFilters(
            $query->selectRaw(
                'nik, nama, mitra_id, count(DISTINCT honor_kegiatan_id) as jumlah_kegiatan, sum(volume * harga_satuan) as nilai_kontrak, sum(volume * harga_satuan) < '.
                  $sbml.
                  ' as valid_sbml '
            )
                ->whereIn('honor_kegiatan_id', $honorKegiatanIds)
                ->join('mitras', 'mitras.id', '=', 'daftar_honor_mitras.mitra_id')
                ->groupBy(['mitra_id', 'nama', 'nik'])
                ->orderBy('nilai_kontrak', 'desc')
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('NIK', 'nik')
                ->readOnly(),
            Text::make('Nama', 'nama')
                ->readOnly(),
            Number::make('Jumlah Kegiatan', 'jumlah_kegiatan')
                ->readOnly(),
            Currency::make('Nilai Kontrak', 'nilai_kontrak')
                ->currency('IDR')
                ->locale('id')
                ->readOnly(),
            Boolean::make('SBML', 'valid_sbml')
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
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return parent::actions($request);
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
