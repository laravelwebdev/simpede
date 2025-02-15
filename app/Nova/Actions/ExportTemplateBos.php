<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

class ExportTemplateBos extends Action
{
    use InteractsWithQueue, Queueable;

    public function name()
    {
        return 'Export Template BOS';
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        if (empty($model->sheet_name)) {
            return Action::danger('Template BOS belum pernah diimport. Lakukan Import dari Template BOS terlebih dahulu');
        }
        $satuan = strtoupper(str_replace([' ', '-'], '', $model->satuan));
        $sheetCollection = Helper::makeCollectionForExportOnSheet($model->id, $model->tangal_spj, 1);
        if (in_array($satuan, ['OB', 'BULAN', '0B'])) {
            $sheetCollection = Helper::makeCollectionForExportOnSheet($model->id, $model->tangal_spj, 1, $fields->awal, $fields->akhir);
        }
        $filename = $fields->filename.'.xlsx';
        $sheets = new SheetCollection([
            'Template' => $sheetCollection,
            $model->sheet_name => Helper::makeCollectionForExportOnSheet($model->id, $model->tangal_spj, 2),
        ]);
        (new FastExcel($sheets))->export(Storage::disk('temp')->path($filename));

        return Action::redirect(route('dump-download', [
            'filename' => $filename,
        ]));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan Awal', 'awal')
                ->options(Helper::$bulan)
                ->searchable()
                ->rules('required', 'min:1', 'max:12'),
            Select::make('Bulan Akhir', 'akhir')
                ->options(Helper::$bulan)
                ->searchable()
                ->rules('required', 'min:1', 'max:12', 'gte:awal'),
            Text::make('Nama File', 'filename')
                ->rules('required', 'regex:/^[a-zA-Z0-9_\-\s]+$/')
                ->help('tanpa extensi file')
                ->default(fn () => uniqid()),
        ];
    }
}
