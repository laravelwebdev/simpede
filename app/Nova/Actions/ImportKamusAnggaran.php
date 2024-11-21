<?php

namespace App\Nova\Actions;

use App\Models\KamusAnggaran;
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

class ImportKamusAnggaran extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import POK SATU DJA';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        KamusAnggaran::cache()->disable();
        KamusAnggaran::where('dipa_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) use ($model, $fields) {
            $replaces[$fields->satker.'.'] = '';
            $replaces['.'.$fields->wilayah] = '';
            $anggaran = explode('||', $row['Kode'])[0];
            $mak = strtr($anggaran, $replaces);
            if ($mak) {
                $kamusAnggaran = KamusAnggaran::firstOrNew(
                    [
                        'mak' => $mak,
                        'dipa_id' => $model->id,
                    ]
                );
                $kamusAnggaran->detail = $row['Program/ Kegiatan/ KRO/ RO/ Komponen'];
                $kamusAnggaran->updated_at = now();
                $kamusAnggaran->save();
            }
        });
        KamusAnggaran::where('updated_at', null)->delete();
        KamusAnggaran::cache()->enable();
        KamusAnggaran::cache()->updateAll();

        return Action::message('Kamus Anggaran sukses diimport!');
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
