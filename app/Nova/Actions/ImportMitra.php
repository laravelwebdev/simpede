<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Imports\MitrasImport;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportMitra extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        DB::table('mitras')->where('tahun', $fields->tahun)->delete();
        Excel::import(new MitrasImport($fields->tahun), $fields->file);

        return Action::message('Mitra sukses diimport!');
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
            Heading::make('<a href = "'.Storage::disk('templates')->url(Template::cache()->get('all')->where('slug', 'template_import_mitra')->first()->file).'">Unduh Template</a>')
                ->asHtml(),
            Select::make('Tahun')
                ->options(fn () => Helper::setOptionTahun())
                ->rules('required'),
        ];
    }
}
