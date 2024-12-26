<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\Masterwilayah;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportMasterwilayah extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Master Wilayah';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        Masterwilayah::cache()->disable();
        Masterwilayah::query()->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) {
            $masterwilayah = Masterwilayah::firstOrNew(
                [
                    'kode' => $row['kode'],
                ]
            );
            $masterwilayah->wilayah = $row['wilayah'];
            $masterwilayah->updated_at = now();

            $masterwilayah->save();
        });
        $ids = Masterwilayah::where('updated_at', null)->get()->pluck('id');
        Masterwilayah::destroy($ids);
        Masterwilayah::cache()->enable();
        Masterwilayah::cache()->updateAll();

        return Action::message('Master Wilayah sukses diimport!');
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
                ->help('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePathByName('Template Import Master Wilayah')['filename']).'">Unduh Template</a>'),
        ];
    }
}
