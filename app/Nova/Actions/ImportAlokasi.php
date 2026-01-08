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
        SusenasAlokasi::query()->update(['updated_at' => null]);
        SusenasCacah::query()->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($line) {
            $alokasi = SusenasAlokasi::firstOrNew(['nks' => $line['NKS']]);
            $alokasi->prov = $line['Kode Prov'];
            $alokasi->kab = $line['Kode Kab'];
            $alokasi->kode_pcl = $line['Kode PCL'];
            $alokasi->pcl = $line['Nama PCL'];
            $alokasi->kode_pml = $line['Kode PML'];
            $alokasi->pml = $line['Nama PML'];
            $alokasi->statusc = 'belum';
            $alokasi->updated_at = now();
            $alokasi->save();
            for ($nus = 1; $nus <= $line['Jumlah Sampel']; $nus++) {
                $cacah = SusenasCacah::firstOrNew([
                    'nks' => $line['NKS'],
                    'nus' => $nus,
                ]);
                $cacah->prov = $line['Kode Prov'];
                $cacah->kab = $line['Kode Kab'];
                $cacah->kode_pcl = $line['Kode PCL'];
                $cacah->pcl = $line['Nama PCL'];
                $cacah->kode_pml = $line['Kode PML'];
                $cacah->pml = $line['Nama PML'];
                $cacah->nus0324 = $nus;
                $cacah->statusc = 'belum';
                $cacah->updated_at = now();
                $cacah->save();
            }
        });
        SusenasAlokasi::where('updated_at', null)->delete();
        SusenasCacah::where('updated_at', null)->delete();

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
