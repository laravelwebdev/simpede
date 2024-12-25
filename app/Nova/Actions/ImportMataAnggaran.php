<?php

namespace App\Nova\Actions;

use App\Models\JenisBelanja;
use App\Models\MataAnggaran;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportMataAnggaran extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Mata Anggaran Monsakti';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $filePath = $fields->file->path();
        $newFilePath = $filePath.'.'.$fields->file->getClientOriginalExtension();
        move_uploaded_file($filePath, $newFilePath);
        $model = $models->first();
        MataAnggaran::cache()->disable();
        MataAnggaran::where('dipa_id', $model->id)->update(['updated_at' => null]);
        $collections = (new FastExcel)->import($newFilePath);
        $index = 0;
        foreach ($collections as $row) {
            $mataAnggaran = MataAnggaran::firstOrNew(
                [
                    'coa_id' => $row['CONS_ITEM'],
                    'dipa_id' => $model->id,
                ]
            );
            $mataAnggaran->mak = $fields->kode.'.'.$row['KODE_PROGRAM'].'.'.$row['KODE_KEGIATAN']
                                                .'.'.$row['KODE_OUTPUT'].'.'.$row['KODE_SUBOUTPUT']
                                                .'.'.$row['KODE_KOMPONEN'].'.'.$row['KODE_SUBKOMPONEN']
                                                .'.'.$row['KODE_AKUN'];
            $mataAnggaran->uraian = $row['URAIAN_ITEM'];
            $mataAnggaran->volume = $row['VOLKEG'];
            $mataAnggaran->satuan = $row['SATKEG'];
            $mataAnggaran->harga_satuan = $row['HARGASAT'];
            $mataAnggaran->total = $row['TOTAL'];
            $mataAnggaran->blokir = $row['NILAI_BLOKIR'];
            if ($fields->update_rpd) {
                $mataAnggaran->rpd_1 = $row['POK_NILAI_1'];
                $mataAnggaran->rpd_2 = $row['POK_NILAI_2'];
                $mataAnggaran->rpd_3 = $row['POK_NILAI_3'];
                $mataAnggaran->rpd_4 = $row['POK_NILAI_4'];
                $mataAnggaran->rpd_5 = $row['POK_NILAI_5'];
                $mataAnggaran->rpd_6 = $row['POK_NILAI_6'];
                $mataAnggaran->rpd_7 = $row['POK_NILAI_7'];
                $mataAnggaran->rpd_8 = $row['POK_NILAI_8'];
                $mataAnggaran->rpd_9 = $row['POK_NILAI_9'];
                $mataAnggaran->rpd_10 = $row['POK_NILAI_10'];
                $mataAnggaran->rpd_11 = $row['POK_NILAI_11'];
                $mataAnggaran->rpd_12 = $row['POK_NILAI_12'];
            }

            $mataAnggaran->updated_at = now();
            $index++;
            $mataAnggaran->ordered = $index;
            $mataAnggaran->save();
        }
        MataAnggaran::where('updated_at', null)->delete();
        MataAnggaran::cache()->enable();
        MataAnggaran::cache()->updateAll();
        $jenis_belanjas = MataAnggaran::cache()->get('all')->unique('jenis_belanja')->pluck('jenis_belanja');
        JenisBelanja::cache()->disable();
        JenisBelanja::where('dipa_id', $model->id)->update(['updated_at' => null]);
        foreach ($jenis_belanjas as $jenis_belanja) {
            $jenisBelanja = JenisBelanja::firstOrNew(
                [
                    'kode' => $jenis_belanja,
                    'dipa_id' => $model->id,
                ]
            );
            $jenisBelanja->updated_at = now();
            $jenisBelanja->save();
        }
        JenisBelanja::where('updated_at', null)->delete();
        JenisBelanja::cache()->enable();
        JenisBelanja::cache()->updateAll();

        $model->revisi = $fields->revisi;
        $model->tanggal_revisi = $fields->tanggal_revisi;
        $model->save();

        return Action::message('Mata Anggaran sukses diimport!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Heading::make('Import Mata Anggaran Monsakti'),
            File::make('File')
                ->rules('required', 'mimes:csv')
                ->acceptedTypes('.csv')
                ->help('File import diambil mon sakti (Anggaran - Download Data Mentah Penganggaran)'),
            Text::make('Kode Satker/Kementrian', 'kode')
                ->rules('required')
                ->default('054.01'),
            Number::make('Revisi ke- ', 'revisi')
                ->rules('required', 'gt:0')
                ->step(1),
            Date::make('Tanggal Revisi', 'tanggal_revisi')
                ->rules('required'),
            Boolean::make('Revisi RPD Triwulanan?', 'update_rpd')
                ->help('Centang jika revisi merupakan revisi pemutakhiran RPD tiap triwulan'),
        ];
    }
}
