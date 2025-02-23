<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarKontrakMitra;
use App\Models\JenisKontrak;
use App\Models\KontrakMitra;
use App\Models\NaskahDefault;
use App\Models\NaskahKeluar;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class GenerateBastMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Generate BAST Mitra';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        if (! $model->tanggal_bast) {
            return Action::danger('Lengkapi Keterangan BAST lebih dahulu sebelum menggenerate');
        }
        $daftar_kontraks = DaftarKontrakMitra::where('kontrak_mitra_id', $model->kontrak_mitra_id)->get();
        foreach ($daftar_kontraks as $daftar_kontrak) {
            $daftar_kontrak->bast_mitra_id = $model->id;
            if (is_null($daftar_kontrak->bast_naskah_keluar_id)) {
                $kontrak = KontrakMitra::find($model->kontrak_mitra_id);
                $jenis_kontrak_id = optional(JenisKontrak::cache()->get('all')->where('id', $kontrak->jenis_kontrak_id)->first())->jenis;
                $bulan_kontrak = Helper::BULAN[$kontrak->bulan];
                $default_naskah = NaskahDefault::cache()->get('all')
                    ->where('jenis', 'bast')
                    ->first();
                $naskahkeluar = new NaskahKeluar;
                $naskahkeluar->tanggal = $model->tanggal_bast;
                $naskahkeluar->jenis_naskah_id = optional($default_naskah)->jenis_naskah_id;
                $naskahkeluar->kode_arsip_id = $model->kode_arsip_id;
                $naskahkeluar->derajat_naskah_id = optional($default_naskah)->derajat_naskah_id;
                $naskahkeluar->tujuan = optional(Helper::getMitraById($daftar_kontrak->mitra_id))->nama;
                $naskahkeluar->perihal = 'BERITA ACARA SERAH TERIMA HASIL PEKERJAAN MITRA STATISTIK PETUGAS '.strtoupper($jenis_kontrak_id).' BULAN '.strtoupper($bulan_kontrak).' TAHUN '.$kontrak->tahun;
                $naskahkeluar->generate = 'A';
                $naskahkeluar->save();
                $daftar_kontrak->bast_naskah_keluar_id = $naskahkeluar->id;
            }
            if ($daftar_kontrak->status_bast === 'outdated') {
                $daftar_kontrak->status_bast = 'diupdate';
            }
            $daftar_kontrak->save();
        }
        $model::where('id', $model->id)->update(['status' => 'digenerate']);

        return Action::message('BAST Sukses Digenerate');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
