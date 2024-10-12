<?php

namespace App\Nova\Actions;

use App\Models\DaftarKontrakMitra;
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
        if (! $model->tanggal_spk) {
            return Action::danger('Lengkapi Keterangan Kontrak lebih dahulu sebelum menggenerate');
        }
        if ($model->jenis_honor === 'Kontrak Mitra Bulanan') {
            $mitras = DB::table('daftar_honor_mitras')
                ->selectRaw('mitra_id, count(DISTINCT honor_kegiatan_id) as jumlah_kegiatan, sum(volume * harga_satuan) as nilai_kontrak')
                ->where('bulan', $model->bulan)
                ->where('bulan', $model->tahun)
                ->where('jenis', $model->jenis_kontrak)
                ->groupBy('mitra_id')
                ->get();
        }
        if ($model->jenis_honor === 'Kontrak Mitra AdHoc') {
            $mitras = DB::table('daftar_honor_mitras')
                ->selectRaw('mitra_id, count(DISTINCT honor_kegiatan_id) as jumlah_kegiatan, sum(volume * harga_satuan) as nilai_kontrak')
                ->where('bulan', $model->honor_kegiatan_id)
                ->groupBy('mitra_id')
                ->get();
        }
        DaftarKontrakMitra::where('kontrak_mitra_id', $model->id)->update(['updated_at' => null]);
        foreach ($mitras as $mitra) {
            $daftar_mitra = DaftarKontrakMitra::firstOrNew(
                [
                    'mitra_id' => $mitra->mitra_id,
                    'kontrak_mitra_id' => $mitra->kontrak_mitra_id,
                ]
            );
            $daftar_mitra->jumlah_kegiatan = $mitra->jumlah_kegiatan;
            $daftar_mitra->nilai_kontrak = $mitra->nilai_kontrak;
            $daftar_mitra->save();
            // TODO: buat nomor d event DaftarKontrak, jika tanggal berubah di kontrak, supdate semua nomor, evant hapus lihat contoh di HOnorKegiatan
        }
        $model->status = 'selesai';
        $model->save();
        DaftarKontrakMitra::where('updated_at', null)->delete();
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
