<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\SusenasAlokasi;
use App\Models\SusenasCacah;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportAlokasi extends DestructiveAction
{
    use InteractsWithQueue;
    use Queueable;

    public $withoutActionEvents = true;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        SusenasAlokasi::query()->delete();
        SusenasCacah::query()->delete();
        (new FastExcel)->import($fields->file, function ($line) {
            SusenasAlokasi::create([
                'prov' => $line['Kode Prov'],
                'kab' => $line['Kode Kab'],
                'nks' => $line['NKS'],
                'kode_pcl' => $line['Kode PCL'],
                'pcl' => $line['Nama PCL'],
                'kode_pml' => $line['Kode PML'],
                'pml' => $line['Nama PML'],
                'statusc' => 'belum',
            ]);
            for ($nus = 1; $nus <= 10; $nus++) {
                SusenasCacah::create([
                    'prov' => $line['Kode Prov'],
                    'kab' => $line['Kode Kab'],
                    'nks' => $line['NKS'],
                    'kode_pcl' => $line['Kode PCL'],
                    'pcl' => $line['Nama PCL'],
                    'kode_pml' => $line['Kode PML'],
                    'pml' => $line['Nama PML'],
                    'nus' => $nus,
                    'nus0324' => $nus,
                    'statusc' => 'belum',
                ]);
            }
        });

        return Action::message('Alokasi Petugas sukses diimport!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            File::make('File')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePathByName('Template Import Alokasi Petugas')['filename']).'">Unduh Template</a>'),

        ];
    }
}
