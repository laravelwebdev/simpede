<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarHonorMitra;
use App\Models\DaftarKontrakMitra;
use App\Models\HonorKegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class GenerateKontrakMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Generate Kontrak Mitra';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        if ($model->jenis_honor === 'Kontrak Mitra Bulanan') {
            $honorKegiatanIds = HonorKegiatan::where('bulan', $model->bulan)
                ->where('tahun', $model->tahun)
                ->where('jenis_kontrak_id', $model->jenis_kontrak_id)
                ->get()
                ->pluck('id');
        }
        if ($model->jenis_honor === 'Kontrak Mitra AdHoc') {
            $honorKegiatanIds = $model->honor_kegiatan_id;
        }

        $mitras = DB::table('daftar_honor_mitras')
            ->selectRaw('mitra_id, count(DISTINCT honor_kegiatan_id) as jumlah_kegiatan, sum(volume_realisasi * harga_satuan) as nilai_kontrak')
            ->whereIn('honor_kegiatan_id', $honorKegiatanIds)
            ->groupBy('mitra_id')
            ->get();

        DaftarKontrakMitra::where('kontrak_mitra_id', $model->id)->update(['updated_at' => null]);
        foreach ($mitras as $mitra) {
            $daftar_mitra = DaftarKontrakMitra::firstOrNew(
                [
                    'mitra_id' => $mitra->mitra_id,
                    'kontrak_mitra_id' => $model->id,
                ]
            );

            $daftarHonorIds = DaftarHonorMitra::where('mitra_id', $mitra->mitra_id)
                ->get()
                ->pluck('honor_kegiatan_id');
            $jumlah_kontrak = HonorKegiatan::whereIn('id', $daftarHonorIds)
                ->where('bulan', $model->bulan)
                ->where('tahun', $model->tahun)
                ->distinct(['jenis_kontrak_id', 'jenis_honor'])
                ->count();
            if ($mitra->nilai_kontrak <= optional(Helper::getJenisKontrakById($model->jenis_kontrak_id))->sbml) {
                $daftar_mitra->valid_sbml = true;
            }

            if ($daftar_mitra->status_kontrak === 'outdated') {
                $daftar_mitra->status_kontrak = 'diupdate';
            }

            if ($jumlah_kontrak <= 1) {
                $daftar_mitra->valid_jumlah_kontrak = true;
            }

            $daftar_mitra->jumlah_kegiatan = $mitra->jumlah_kegiatan;
            $daftar_mitra->nilai_kontrak = $mitra->nilai_kontrak;
            $daftar_mitra->updated_at = now();
            $daftar_mitra->save();
            DaftarHonorMitra::where('mitra_id', $mitra->mitra_id)
                ->whereIn('honor_kegiatan_id', $honorKegiatanIds)
                ->update(['daftar_kontrak_mitra_id' => $daftar_mitra->id]);
        }
        $model::where('id', $model->id)->update(['status' => 'digenerate']);
        $ids = DaftarKontrakMitra::where('updated_at', null)->get()->pluck('id');
        DaftarKontrakMitra::destroy($ids);

        return Action::message('Kontrak Sukses Digenerate');
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
