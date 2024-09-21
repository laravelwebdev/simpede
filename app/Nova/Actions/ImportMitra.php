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
        Excel::import(new MitrasImport($model->id), $fields->file);
        Mitra::where('updated_at', null)->delete();
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
                ->acceptedTypes('.xlsx')->help('Data akan diperbaharui dengan data baru'),
            Heading::make('Gunakan File Excel Export Mitra dari Aplikasi SOBAT'),
        ];
    }
}
