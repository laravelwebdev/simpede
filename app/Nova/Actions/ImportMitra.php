<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\Mitra;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $withoutActionEvents = true;

    public $name = 'Impor Mitra';

    /**
     * Perform the action on the given models.
     *'.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        Mitra::cache()->disable();
        Mitra::where('kepka_mitra_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) use ($model) {
            if ($row['Status Seleksi (1=Terpilih, 2=Tidak Terpilih)'] == 'Diterima') {
                $mitra = Mitra::firstOrNew(
                    [
                        'email' => $row['Email'],
                        'kepka_mitra_id' => $model->id,
                    ]
                );

                $mitra->nama = $row['Nama Lengkap'];
                $mitra->alamat = $row['Alamat Detail'];
                    // ✅ FIX UTAMA DI SINI
                if ($row['Tgl lahir'] instanceof DateTimeInterface) {
                    $mitra->tanggal_lahir = Carbon::instance($row['Tgl lahir'])->format('Y-m-d');
                } else {
                    $mitra->tanggal_lahir = Carbon::createFromFormat('d/m/Y', $row['Tgl lahir'])->format('Y-m-d');
                }
                $mitra->telepon = $row['No Telp'];
                $mitra->idsobat = $row['SOBAT ID'];
                $mitra->updated_at = now();

                $mitra->save();
            }
        });
        $ids = Mitra::where('updated_at', null)->get()->pluck('id');
        Mitra::destroy($ids);
        (new FastExcel)->import($fields->file_nik, function ($row) use ($model) {
            Mitra::where('kepka_mitra_id', $model->id)
                ->where('email', $row['Email'])
                ->update(['nik' => $row['NIK'], 'npwp' => $row['NPWP']]);
        });
        Mitra::cache()->enable();
        Mitra::cache()->updateAll();

        return Action::message('Mitra sukses diimport!');
    }

    /*'
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Heading::make('Import Data Mitra dari Aplikasi SOBAT'),
            File::make('File')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('File didapat dari hasil export Data Mitra dari Aplikasi SOBAT dengan format excel'),
            Heading::make('Import Data NIK Mitra'),
            File::make('File', 'file_nik')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePathByName('Template Import NIK Mitra')['filename']).'">Unduh Template</a>'),
        ];
    }
}
