<?php

namespace App\Nova\Actions;

use App\Imports\DaftarHonorImport;
use App\Models\DaftarHonor;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Lednerb\ActionButtonSelector\ShowAsButton;
use Maatwebsite\Excel\Facades\Excel;

class ImportDaftarHonor extends Action
{
    use InteractsWithQueue, Queueable, ShowAsButton;
    public $name = 'Import dari BOS';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        DaftarHonor::where('honor_survei_id', $model->id)->delete();
        Excel::import(new DaftarHonorImport([$model->id, $model->bulan, $model->jenis]), $fields->file);

        return Action::message('File BOS sukses diimport!');
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
                ->rules('required', 'mimes:xlsx')->acceptedTypes('.xlsx'),
        ];
    }
}
