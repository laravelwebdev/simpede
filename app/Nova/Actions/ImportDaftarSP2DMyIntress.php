<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarKegiatan;
use App\Models\DaftarSp2d;
use App\Models\UangPersediaan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportDaftarSP2DMyIntress extends Action
{
    use InteractsWithQueue, Queueable;

    public $withoutActionEvents = true;

    public $name = 'Import Daftar SP2D MyIntress';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();

        UangPersediaan::where('dipa_id', $model->id)->update(['updated_at' => null]);
        DaftarSp2d::where('dipa_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->startRow(2)->import($fields->myintress, function ($row) use ($model) {
            $no_sp2d = str_replace("'", '', trim($row['No. SP2D']));
            $no_spp = str_replace("'", '', trim($row['No. SPP/SPM']));
            $jenis_spp = trim(explode(' - ', $row['Jenis SPP/SPM'])[1]);
            $jumlah = (int) str_replace('.', '', trim((string) $row['Jumlah Pengeluaran']));
            if (strlen($no_sp2d) > 1) {
                $daftarsp2d = DaftarSp2d::firstOrNew(
                    [
                        'nomor_sp2d' => $no_sp2d,
                        'dipa_id' => $model->id,
                    ]
                );
                $daftarsp2d->tanggal_sp2d = $row['Tanggal SP2D'];
                $daftarsp2d->tanggal_spm = $row['Tanggal SPM'];
                $daftarsp2d->tanggal_spp = $row['Tanggal SPP'];
                $daftarsp2d->nomor_spp = $no_spp;
                $daftarsp2d->jumlah = $jumlah;
                $daftarsp2d->uraian = $row['Uraian SPP/SPM'];
                $daftarsp2d->updated_at = now();
                $daftarsp2d->save();
                if (in_array($jenis_spp, Helper::JENIS_UP)) {
                    $daftarSp2dUp = UangPersediaan::firstOrNew(
                        [
                            'dipa_id' => $model->id,
                            'nomor_sp2d' => $no_sp2d,
                        ]
                    );
                    $daftarSp2dUp->tanggal = $row['Tanggal SP2D'];
                    $daftarSp2dUp->nilai = $jumlah;
                    $daftarSp2dUp->jenis = $jenis_spp;
                    $daftarSp2dUp->updated_at = now();

                    $daftarSp2dUp->save();
                }
            }
        });

        DaftarSp2d::where('updated_at', null)->delete();
        $ids = UangPersediaan::where('updated_at', null)->get()->pluck('id');
        UangPersediaan::destroy($ids);

        $model->tanggal_realisasi = DaftarSp2d::max('tanggal_sp2d');
        $model->save();

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
            File::make('Daftar SP2D MyIntress', 'myintress')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('File import diambil MyIntress-> Pembayaran->Monitoring SPP, SPM, dan SP2D->Download Excel.'),
        ];
    }
}
