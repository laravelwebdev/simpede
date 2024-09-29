<?php

namespace App\Nova\Actions;

use App\Models\KamusAnggaran;
use App\Models\MataAnggaran;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportMataAnggaran extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import POK';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        MataAnggaran::cache()->disable();
        KamusAnggaran::cache()->disable();
        MataAnggaran::where('dipa_id', $model->id)->update(['updated_at' => null]);
        KamusAnggaran::where('dipa_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) use ($model, $fields) {
            $replaces[$fields->satker.'.'] = '';
            $replaces['.'.$fields->wilayah] = '';
            $anggaran = explode('||', $row['Kode'])[0];
            $mak = strtr($anggaran, $replaces);
            if ($mak) {
                KamusAnggaran::updateOrCreate(
                    [
                        'mak' => $mak,
                        'dipa_id' => $model->id,
                    ],
                    [
                        'detail' => $row['Program/ Kegiatan/ KRO/ RO/ Komponen'],
                        'updated_at' => now(),
                        'satuan' => $row['Volume'] != '' ? explode(' ', $row['Volume'])[1] : '',
                    ]
                );
            }
            if (strlen($mak) == 37) {
                MataAnggaran::updateOrCreate(
                    [
                        'mak' => substr($mak, 0, 35),
                        'dipa_id' => $model->id,
                    ],
                    [
                        'updated_at' => now(),
                    ]
                );
            }
        });
        MataAnggaran::where('updated_at', null)->delete();
        KamusAnggaran::where('updated_at', null)->delete();
        MataAnggaran::cache()->enable();
        MataAnggaran::cache()->update('all');
        KamusAnggaran::cache()->enable();
        KamusAnggaran::cache()->update('all');

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
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')->help('Data akan diperbaharui dengan data baru'),
            Text::make('Kode Satker', 'satker')
                ->default('428578')
                ->rules('required')
                ->help('Kode Satker, misal: 428578'),
            Text::make('Kode Wilayah', 'wilayah')
                ->default('15.00')
                ->rules('required')
                ->help('Kode Wilayah Satker, misal: 15.00'),
            Heading::make('File import diambil dari excel satudja dan simpan sebagai file .xlsx'),
        ];
    }
}
