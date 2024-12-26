<?php

namespace App\Nova\Actions;

use App\Models\DaftarSp2d;
use App\Models\MataAnggaran;
use App\Models\RealisasiAnggaran;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportRealisasiAnggaran extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Realisasi Anggaran Monsakti';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        RealisasiAnggaran::where('dipa_id', $model->id)->update(['updated_at' => null]);
        DaftarSp2d::where('dipa_id', $model->id)->update(['updated_at' => null]);
        $mataAnggarans = MataAnggaran::cache()
            ->get('all')
            ->where('dipa_id', $model->id)
            ->pluck('id', 'coa_id')
            ->all();
        (new FastExcel)->startRow(2)->import($fields->file, function ($row) use ($model, $mataAnggarans) {
            $array_coa = explode('.', $row['KODE COA']);
            $coa_id = end($array_coa);
            $mak_id = $mataAnggarans[(int) $coa_id];
            $daftarsp2d = DaftarSp2d::firstOrNew(
                [
                    'nomor_sp2d' => str_replace("'", '', $row['NO SP2D']),
                    'dipa_id' => $model->id,
                ]
            );
            $daftarsp2d->tanggal_sp2d = $row['TANGGAL SP2D'];
            $daftarsp2d->nomor_spp = str_replace("'", '', $row['NO SPP']);
            $daftarsp2d->uraian = $row['URAIAN'];
            $daftarsp2d->updated_at = now();
            $daftarsp2d->save();
            $realisasiAnggaran = RealisasiAnggaran::firstOrNew(
                [
                    'daftar_sp2d_id' => $daftarsp2d->id,
                    'mata_anggaran_id' => $mak_id,
                    'dipa_id' => $model->id,
                ]
            );
            $realisasiAnggaran->nilai = $row['NILAI RUPIAH'];
            $realisasiAnggaran->updated_at = now();
            $realisasiAnggaran->save();
        });
        RealisasiAnggaran::where('updated_at', null)->delete();
        DaftarSp2d::where('updated_at', null)->delete();
        $model->tanggal_realisasi = DaftarSp2d::max('tanggal_sp2d');
        $model->save();

        return Action::message('Realisasi Anggaran sukses diimport!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            File::make('File')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('File import diambil mon sakti (Pembayaran - Monitoring Detail Transaksi FA 16 Segmen Versi SP2D - Kosongkan Pilihan Tanggal).'),
        ];
    }
}
