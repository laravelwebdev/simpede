<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportTemplateSekar extends Action
{
    use InteractsWithQueue;
    use Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $filename = $fields->filename.'.xlsx';
        (new FastExcel($models))->export(Storage::disk('temp')->path($filename), function ($model) {
            return [
                'Nomor' => $model->nomor,
                'Kode Klasifikasi' => $model->kode_klasifikasi,
                'Kode Unit Cipta' => $model->kode_unit_cipta,
                'Uraian' => $model->uraian,
                'Kurun Waktu Awal' => $model->kurun_awal,
                'Kurun Waktu Akhir' => $model->kurun_akhir,
                'Tingkat Perkembangan' => $model->tingkat_perkembangan,
                'Media Simpan' => $model->media_simpan,
                'Kondisi Fisik' => $model->kondisi,
                'Jumlah Berkas' => $model->jumlah,
                'Kode Ruang' => $model->kode_ruang,
                'Nomor Lemari' => implode('.', array_slice(explode('.', $model->nomor_lemari), 0, -1)),
                'Nomor Boks' => collect(explode('.', $model->nomor_lemari))->last(),
                'Nomor Folder' => $model->nomor,
            ];
        });

        return Action::redirect(route('dump-download', [
            'filename' => $filename,
        ]));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Text::make('Nama File', 'filename')
                ->rules('required', 'regex:/^[a-zA-Z0-9_\-\s]+$/')
                ->help('tanpa extensi file')
                ->default(fn () => uniqid()),
        ];
    }
}
