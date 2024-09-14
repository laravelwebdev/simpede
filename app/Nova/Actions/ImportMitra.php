<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Imports\MitrasImport;
use App\Models\Mitra;
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

class ImportMitra extends Action
{
    use InteractsWithQueue, Queueable;
    public $name = 'Import';

    /**
     * Perform the action on the given models.
     *'.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        Mitra::cache()->disable();
        Mitra::where('tahun', session('year'))->delete();
        Excel::import(new MitrasImport, $fields->file);
        Mitra::cache()->enable();
        Mitra::cache()->update('all');

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
                ->acceptedTypes('.xlsx')->help('Data Lama Akan dihapus dan ditimpa data baru'),
            Heading::make('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePath('import_mitra')).'">Unduh Template</a>')
                ->asHtml(),
        ];
    }
}
