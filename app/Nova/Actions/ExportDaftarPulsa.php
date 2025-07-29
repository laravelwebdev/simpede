<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use App\Models\DaftarPulsaMitra;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExportDaftarPulsa extends Action
{
    use InteractsWithQueue, Queueable;

    public function name()
    {
        return 'Export Daftar Pulsa';
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        if (DaftarPulsaMitra::where('pulsa_kegiatan_id', $model->id)->where('confirmed', false)->count() > 0) {
            return Action::danger('Masih Ada Mitra yang belum mengkonfirmasi nomor HP');
        }
        $filename = $fields->filename.'.xlsx';
        (new FastExcel(DaftarPulsaMitra::where('pulsa_kegiatan_id', $model->id)->get()))->export(Storage::disk('temp')->path($filename), function ($pulsa) {
            return [
                'No HP' => optional(Helper::getMitraById($pulsa->mitra_id))->no_pulsa,
                'Nominal' => $pulsa->nominal,

            ];
        });

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
            Text::make('Nama File', 'filename')
                ->rules('required', 'regex:/^[a-zA-Z0-9_\-\s]+$/')
                ->help('tanpa extensi file')
                ->default(fn () => uniqid()),
        ];
    }
}
