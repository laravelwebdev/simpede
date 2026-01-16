<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarPenilaianReward;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportRekapPresensi extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Impor Rekap Presensi BOS';

    /**
     * Perform the action on the given models.
     *'.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        DaftarPenilaianReward::where('reward_pegawai_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->startRow(5)->import($fields->file, function ($row) use ($model, $fields) {
            $user = User::cache()->get('all')->where('nip_lama', $row['NIP'])->first();
            if ($user && is_array($fields->kecualikan) && in_array($user->id, $fields->kecualikan)) {
                return;
            }

            $daftar = DaftarPenilaianReward::firstOrNew(
                [
                    'user_id' => optional($user)->id,
                    'reward_pegawai_id' => $model->id,
                ]
            );
            $daftar->hk = $row['HK'];
            $daftar->hd = (int) $row['HD'] + (int) $row['TL'] + (int) $row['PD'] + (int) $row['DK'] + (int) $row['KN'];
            $daftar->cst = (int) $row['CST1'] + (int) $row['CST2'];
            $daftar->tb = $row['TB'];
            $daftar->tk = $row['TK'];
            $daftar->tl1 = $row['TL1'];
            $daftar->tl2 = $row['TL2'];
            $daftar->tl3 = $row['TL3'];
            $daftar->tl4 = $row['TL4'];
            $daftar->psw1 = $row['PSW1'];
            $daftar->psw2 = $row['PSW2'];
            $daftar->psw3 = $row['PSW3'];
            $daftar->psw4 = $row['PSW4'];
            $daftar->updated_at = now();

            $daftar->save();
        });

        (new FastExcel)->import($fields->skp, function ($row) use ($model, $fields) {
            $user = User::cache()->get('all')->where('nip_lama', $row['Niplama'])->first();
            if (
                strtoupper($row['Status']) === 'DINILAI' &&
                ! (
                    $user &&
                    is_array($fields->kecualikan) &&
                    in_array($user->id, $fields->kecualikan)
                )
            ) {
                $daftar = DaftarPenilaianReward::firstOrNew(
                    [
                        'user_id' => optional($user)->id,
                        'reward_pegawai_id' => $model->id,
                    ]
                );
                $daftar->nilai_skp = $row['Rata-rata hasil kerja'] ?? 0;
                $daftar->nilai_perilaku = $row['Rata-rata perilaku'] ?? 0;
                $daftar->updated_at = now();

                $daftar->save();
            }
        });
        $ids = DaftarPenilaianReward::where('updated_at', null)->get()->pluck('id');
        DaftarPenilaianReward::destroy($ids);
        $model->status = 'diimport';
        $model->save();

        return Action::message('Rekap Presensi dan Penilaian SKP sukses diimport!');
    }

    /*'
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            File::make('Rekap Presensi', 'file')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('Gunakan File Excel Export dari Aplikasi BOS (Menu Kepegawaian->Cetak Presensi->Rekap Presensi Unit Kerja'),
            File::make('Penilaian SKP', 'skp')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('Gunakan File Excel Export dari Aplikasi KipApp (Masuk dengan Akun Kepala, Menu Penilaian Kinerja - Rekap Prestasi Periodik - Download Excel'),
            MultiSelect::make('Dikecualikan dari Penilaian', 'kecualikan')
                ->options(Helper::setOptionPengelola('anggota', now()))
                ->help('Pilih pegawai yang tidak perlu dinilai pada periode ini.'),
        ];
    }
}
