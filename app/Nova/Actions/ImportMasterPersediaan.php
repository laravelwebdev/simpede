<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\MasterPersediaan;
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

class ImportMasterPersediaan extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Master Persediaan';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        MasterPersediaan::cache()->disable();
        MasterPersediaan::query()->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) {
            $masterPersediaan = MasterPersediaan::firstOrNew(
                [
                    'kode' => $row['kode'],
                ]
            );
            $masterPersediaan->barang = $row['barang'];
            $masterPersediaan->satuan = $row['satuan'];
            $masterPersediaan->updated_at = now();

            $masterPersediaan->save();
        });
        $ids = MasterPersediaan::where('updated_at', null)->get()->pluck('id');
        MasterPersediaan::destroy($ids);
        MasterPersediaan::cache()->enable();
        MasterPersediaan::cache()->update('all');

        return Action::message('Master Persediaan sukses diimport!');
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
            Heading::make('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePathByName('Template Import Master Persediaan')['filename']).'">Unduh Template</a>')
                ->asHtml(),
        ];
    }
}
