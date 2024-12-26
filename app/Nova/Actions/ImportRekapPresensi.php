<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarPenilaianReward;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
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
        (new FastExcel)->startRow(5)->import($fields->file, function ($row) use ($model) {
            $daftar = DaftarPenilaianReward::firstOrNew(
                [
                    'user_id' => Helper::getPropertyFromCollection(User::cache()->get('all')->where('nip_lama', $row['NIP'])->first(), 'id'),
                    'reward_pegawai_id' => $model->id,
                ]
            );
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
        $ids = DaftarPenilaianReward::where('updated_at', null)->get()->pluck('id');
        DaftarPenilaianReward::destroy($ids);
        $model->status = 'diimport';
        $model->save();

        return Action::message('Rekap Presensi sukses diimport!');
    }

    /*'
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
                ->help('Gunakan File Excel Export dari Aplikasi BOS (Menu Kepegawaian->Cetak Presensi->Rekap Presensi Unit Kerja'),
        ];
    }
}
