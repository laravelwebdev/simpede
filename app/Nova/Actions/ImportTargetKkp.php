<?php

namespace App\Nova\Actions;

use App\Models\TargetKkp;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportTargetKkp extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Target Penggunaan KKP';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $rows = (new FastExcel)->startRow(3)->withoutHeaders()->import($fields->file);
        $periode = null;

        foreach ($rows as $row) {
            // ambil kolom periode (kolom pertama)
            if (! empty($row[4])) {
                // hapus tanda kutip jika ada, lalu konversi ke integer
                $periode = intval(str_replace("'", '', $row[4]));
            }

            $targetKkp = TargetKkp::where('bulan', $periode)
                ->where('dipa_id', $model->id)->first();
            if ($targetKkp) {
                $targetKkp->nilai = $row[14] ?? 0;
                $targetKkp->save();
            }
        }

        return Action::message('Target Penggunaan KKP sukses diimport!');
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
                ->help('File import diambil OMSPAN-> MONEV PA->Indikator Pelaksanaan Anggaran Satker->Pilih Bulan Desember-> Klik Nilai Pengelolaan UP dan TUP->Download Excel.'),
        ];
    }
}
