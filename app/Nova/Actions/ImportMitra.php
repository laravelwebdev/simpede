<?php

namespace App\Nova\Actions;

use App\Models\Mitra;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportMitra extends Action
{
    use InteractsWithQueue, Queueable;

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
                $mitra->tanggal_lahir = Carbon::createFromFormat('d/m/Y', $row['Tgl lahir']);
                $mitra->telepon = $row['No Telp'];
                $mitra->npwp = $row['NPWP'];
                $mitra->idsobat = $row['SOBAT ID'];
                $mitra->updated_at = now();

                $mitra->save();
            }
        });
        $ids = Mitra::where('updated_at', null)->get()->pluck('id');
        Mitra::destroy($ids);
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
            File::make('File')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('Data akan diperbaharui dengan data baru'),
            Heading::make('Gunakan File Excel Export Mitra dari Aplikasi SOBAT'),
        ];
    }
}
