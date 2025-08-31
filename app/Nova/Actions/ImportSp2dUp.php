<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarKegiatan;
use App\Models\UangPersediaan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportSp2dUp extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import SP2D UP';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        UangPersediaan::where('dipa_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->startRow(2)->import($fields->file, function ($row) use ($model) {
            if (in_array($row['Jenis SPM'], Helper::JENIS_UP)) {
                $daftarSpd = UangPersediaan::firstOrNew(
                    [
                        'dipa_id' => $model->id,
                        'nomor_sp2d' => $row['Nomor SP2D'],
                    ]
                );
                $daftarSpd->tanggal = $row['Tanggal SP2D'];
                $daftarSpd->nilai = $row['Nilai SP2D'];
                $daftarSpd->jenis = $row['Jenis SPM'];
                $daftarSpd->updated_at = now();

                $daftarSpd->save();
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

        return Action::message('Daftar SP2D Uang Persediaan sukses diimport!');
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
                ->help('File import diambil OMSPAN-> Modul Pembayaran->Daftar SP2D->Download Excel.'),
        ];
    }
}
