<?php

namespace App\Nova\Actions;

use App\Imports\MataAnggaransImport;
use App\Models\MataAnggaran;
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

class ImportMataAnggaran extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        MataAnggaran::cache()->disable();
        MataAnggaran::where('tahun', session('year'))->delete();
        Excel::import(new MataAnggaransImport, $fields->file);
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
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')->help('Data Lama Akan dihapus dan ditimpa data baru'),
            Heading::make('<a href = "'.Storage::disk('templates')->url(Template::cache()->get('all')->where('slug', 'template_import_mata_anggaran')->first()->file).'">Unduh Template</a>')
                ->asHtml(),
        ];
    }
}
