<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
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
use Rap2hpoutre\FastExcel\FastExcel;

class ImportNikMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import NIK Mitra';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        Mitra::cache()->disable();
        Mitra::where('kepka_mitra_id', $model->id)->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) use ($model) {
            Mitra::where('kepka_mitra_id', $model->id)->where('email', $row['Email'])->update(['updated_at' => now(), 'nik' => $row['NIK']]);
        });
        $ids = Mitra::where('updated_at', null)->get()->pluck('id');
        Mitra::destroy($ids);
        Mitra::cache()->enable();
        Mitra::cache()->updateAll();

        return Action::message('NIK Mitra sukses diperbaharui');
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
            Heading::make('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePathByName('Template Import NIK Mitra')['filename']).'">Unduh Template</a>')
                ->asHtml(),
        ];
    }
}
