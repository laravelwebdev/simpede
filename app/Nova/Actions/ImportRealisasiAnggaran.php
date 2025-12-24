<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarSp2d;
use App\Models\MataAnggaran;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\File;
use App\Models\DaftarKegiatan;
use App\Models\UangPersediaan;
use Illuminate\Support\Carbon;
use Laravel\Nova\Actions\Action;
use App\Models\RealisasiAnggaran;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class ImportRealisasiAnggaran extends Action
{
    use InteractsWithQueue, Queueable;

    public $withoutActionEvents = true;

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
        (new FastExcel)->startRow(2)->import($fields->monsakti, function ($row) use ($model, $mataAnggarans) {
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

        UangPersediaan::where('dipa_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->startRow(2)->import($fields->spanint, function ($row) use ($model) {
            if (in_array($row['Jenis SPM'], Helper::JENIS_UP)) {
                $daftarSp2dUp = UangPersediaan::firstOrNew(
                    [
                        'dipa_id' => $model->id,
                        'nomor_sp2d' => $row['Nomor SP2D'],
                    ]
                );
                $daftarSp2dUp->tanggal = $row['Tanggal SP2D'];
                $daftarSp2dUp->nilai = $row['Nilai SP2D'];
                $daftarSp2dUp->jenis = $row['Jenis SPM'];
                $daftarSp2dUp->updated_at = now();

                $daftarSp2dUp->save();

            }
            $nomorSp2d = str_replace("'", '', trim($row['Nomor SP2D']));
            if (! empty($nomorSp2d)) {
                $tanggal = Carbon::createFromFormat('d-m-Y', $row['Tanggal Invoice'])->format('Y-m-d');
                DaftarSp2d::where('nomor_sp2d', $nomorSp2d)->update(['tanggal_spm' => $tanggal]);
            }
        });

        $ids = UangPersediaan::where('updated_at', null)->get()->pluck('id');
        UangPersediaan::destroy($ids);

        // set reminder
        $daftarKegiatanIds = DaftarKegiatan::where('kegiatan', 'SPM Penggantian UP (GUP)')
            ->orWhere('kegiatan', 'SPM Pertanggungjawaban TUP (GTUP)')
            ->pluck('id');
        DaftarKegiatan::destroy($daftarKegiatanIds);

        $latestGup = Helper::getLatestGup($model->tahun);
        $latestTup = Helper::getLatestTup($model->tahun);
        if ($latestGup) {
            $deadline = Helper::hitungPeriodeGup($latestGup->tanggal)['akhir'];
            $deadline = ($deadline > $model->tanggal_nihil ? $model->tanggal_nihil : $deadline);
            $deadline = Helper::getTanggalSebelum($deadline, 0, 'HK');
            Helper::setReminderForUangPersediaan('gup', $deadline);
        }
        if ($latestTup) {
            $deadline = Helper::hitungPeriodeGup($latestTup->tanggal)['akhir'];
            $deadline = ($deadline > $model->tanggal_nihil ? $model->tanggal_nihil : $deadline);
            $deadline = Helper::getTanggalSebelum($deadline, 0, 'HK');
            Helper::setReminderForUangPersediaan('tup', $deadline);
        }

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
            File::make('Realisasi Anggaran Monsakti', 'monsakti')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('File import diambil mon sakti (Pembayaran - Monitoring Detail Transaksi FA 16 Segmen Versi SP2D - Kosongkan Pilihan Tanggal).'),
            File::make('Daftar SP2D Spanint', 'spanint')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('File import diambil OMSPAN-> Modul Pembayaran->Daftar SP2D->Download Excel.'),
        ];
    }
}
