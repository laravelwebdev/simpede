<?php

namespace App\Nova\Actions;

use App\Models\RealisasiAnggaran;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
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
        (new FastExcel)->import($fields->file, function ($row) use ($model) {
            $array_coa = explode('.', $row['KODE COA']);
            $coa_id = end($array_coa);
            $realisasiAnggaran = RealisasiAnggaran::firstOrNew(
                [
                    'coa_id' => $coa_id,
                    'dipa_id' => $model->id,
                ]
            );
            $realisasiAnggaran->tanggal_sp2d = $row['TANGGAL SP2D'];
            $realisasiAnggaran->nomor_spp = str_replace("'", '', $row['NO SPP']);
            $realisasiAnggaran->nomor_sp2d = str_replace("'", '', $row['NO SP2D']);
            $realisasiAnggaran->uraian = $row['URAIAN'];
            $realisasiAnggaran->nilai = $row['NILAI RUPIAH'];
            $realisasiAnggaran->updated_at = now();
            $realisasiAnggaran->save();

        });
        RealisasiAnggaran::where('updated_at', null)->delete();

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
                ->acceptedTypes('.xlsx')->help('Data akan diperbaharui dengan data baru'),
            Heading::make('File import diambil mon sakti (Pembayaran - Monitoring Detail Transaksi FA 16 Segmen Versi SP2D - Pilih Tanggal dari 1 Januari - 31 Desember). Selanjutnya Hapus baris di atas header kolom agar header ada di baris pertama'),
        ];
    }
}
