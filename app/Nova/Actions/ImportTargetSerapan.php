<?php

namespace App\Nova\Actions;

use App\Models\JenisBelanja;
use App\Models\TargetSerapanAnggaran;
use Google\Service\CloudDeploy\Target;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportTargetSerapan extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Target Serapan Anggaran';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        // Ambil mapping JenisBelanja (kode → id)
        $jenisMap = JenisBelanja::cache()->get('all')->where('dipa_id', $model->id)->pluck('id', 'kode')->toArray();

        // Import tanpa header
        $rows = (new FastExcel)->startRow(4)->withoutHeaders()->import($fields->file);
        $periode = null;

        foreach ($rows as $row) {
            // ambil kolom periode (kolom pertama)
            if (! empty($row[0])) {
                // hapus tanda kutip jika ada, lalu konversi ke integer
                $periode = intval(str_replace("'", '', $row[0]));
            }

            // cek apakah baris ini "Nominal Target"
            if (isset($row[5]) && trim($row[5]) === 'Nominal Target') {
                $kodeBelanja = [51, 52, 53, 57];

                foreach ($kodeBelanja as $index => $kode) {
                    $nilai = isset($row[6 + $index]) ? intval($row[6 + $index]) : 0;
                    if (isset($jenisMap[$kode])) {
                        $targetSerapan = TargetSerapanAnggaran::where('bulan', $periode)
                            ->where('jenis_belanja_id', $jenisMap[$kode])->first();
                        if ($targetSerapan) {
                            $targetSerapan->nilai = $nilai;
                            $targetSerapan->save();
                        }
                    }
                }
            }
        }

        return Action::message('Target Serapan Anggaran sukses diimport!');
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
                ->help('File import diambil OMSPAN-> MONEV PA->Indikator Pelaksanaan Anggaran Satker->Pilih Bulan Desember-> Klik Nilai Penyerapan Anggaran->Download Excel.'),
        ];
    }
}
