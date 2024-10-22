<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\KodeArsip;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportKodeArsip extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Kode Arsip';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        KodeArsip::cache()->disable();
        KodeArsip::where('tata_naskah_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) use ($model) {
            $kodeArsip = KodeArsip::firstOrNew(
                [
                    'detail' => $row['detail'],
                    'tata_naskah_id' => $model->id,
                    'kode' => $row['kode'],
                ]
            );
            $kodeArsip->group = $row['group'];
            $kodeArsip->updated_at = now();

            $kodeArsip->save();
        });
        $ids = KodeArsip::where('updated_at', null)->get()->pluck('id');
        KodeArsip::destroy($ids);
        KodeArsip::cache()->enable();
        KodeArsip::cache()->update('all');

        return Action::message('Kode Arsip sukses diimport!');
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
            Heading::make('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePathByName('Template Import Kode Arsip')['filename']).'">Unduh Template</a>')
                ->asHtml(),
        ];
    }
}
