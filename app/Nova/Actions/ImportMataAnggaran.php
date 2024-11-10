<?php

namespace App\Nova\Actions;

use App\Models\MataAnggaran;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
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
        (new FastExcel)->import($newFilePath, function ($row) use ($model, $fields) {
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
                $mataAnggaran->rpd_januari = $row['POK_NILAI_1'];
                $mataAnggaran->rpd_februari = $row['POK_NILAI_2'];
                $mataAnggaran->rpd_maret = $row['POK_NILAI_3'];
                $mataAnggaran->rpd_april = $row['POK_NILAI_4'];
                $mataAnggaran->rpd_mei = $row['POK_NILAI_5'];
                $mataAnggaran->rpd_juni = $row['POK_NILAI_6'];
                $mataAnggaran->rpd_juli = $row['POK_NILAI_7'];
                $mataAnggaran->rpd_agustus = $row['POK_NILAI_8'];
                $mataAnggaran->rpd_september = $row['POK_NILAI_9'];
                $mataAnggaran->rpd_oktober = $row['POK_NILAI_10'];
                $mataAnggaran->rpd_november = $row['POK_NILAI_11'];
                $mataAnggaran->rpd_desember = $row['POK_NILAI_12'];
            }

            $mataAnggaran->updated_at = now();
            $mataAnggaran->save();

        });
        MataAnggaran::where('updated_at', null)->delete();
        MataAnggaran::cache()->enable();
        MataAnggaran::cache()->update('all');

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
            File::make('File')
                ->rules('required', 'mimes:csv')
                ->acceptedTypes('.csv')->help('Data akan diperbaharui dengan data baru'),
            Text::make('Kode Satker/Kementrian', 'kode')
                ->rules('required')
                ->default('054.01'),
            Boolean::make('Update Data RPD', 'update_rpd'),
            Heading::make('File import diambil mon sakti (Anggaran - Download Data Mentah Penganggaran)'),
        ];
    }
}
