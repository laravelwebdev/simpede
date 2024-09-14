<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Imports\KodeArsipsImport;
use App\Models\KodeArsip;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Facades\Excel;

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
        Excel::import(new KodeArsipsImport($model->id), $fields->file);
        KodeArsip::where('updated_at', null)->delete();
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
                ->acceptedTypes('.xlsx')->help('Data Lama Akan dihapus dan ditimpa data baru'),
            Heading::make('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePath('import_kode_arsip')).'">Unduh Template</a>')
                ->asHtml(),
        ];
    }
}
