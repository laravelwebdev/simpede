<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarHonorMitra;
use App\Models\HonorKegiatan;
use App\Models\Mitra;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportDaftarHonorMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import dari BOS';

    protected $model;

    public function __construct($honor_kegiatan_id)
    {
        $this->model = HonorKegiatan::where('id', $honor_kegiatan_id);
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $sheetName = Helper::getLastSheetName($fields->file);
        $honor = $this->model->first();
        if ($honor->status == 'dibuat') {
            return Action::danger('Mohon lengkapi terlebih dulu isian honor kegiatan yang akan diimport melalui menu Sunting');
        }
        DaftarHonorMitra::where('honor_kegiatan_id', $honor->id)->update(['updated_at' => null]);
        (new FastExcel)->sheet(2)->import($fields->file, function ($row) use ($honor, $fields) {
            if (strlen($row['nip']) == 16) {
                $mitra_id = Helper::getPropertyFromCollection(Mitra::cache()->get('all')->where('nik', $row['nip'])->where('kepka_mitra_id', $fields->kepka_mitra_id)->first(), 'id');
                $daftarHonorMitra = DaftarHonorMitra::firstOrNew(
                    [
                        'mitra_id' => $mitra_id,
                        'honor_kegiatan_id' => $honor->id,
                    ]
                );

                $daftarHonorMitra->volume_realisasi = $fields->volume;
                $daftarHonorMitra->volume_target = $fields->volume;
                $daftarHonorMitra->harga_satuan = $fields->harga_satuan;
                $daftarHonorMitra->persen_pajak = $fields->persen_pajak;
                $daftarHonorMitra->updated_at = now();

                $daftarHonorMitra->save();
            }
        });
        $ids = DaftarHonorMitra::where('updated_at', null)->get()->pluck('id');
        DaftarHonorMitra::destroy($ids);
        $honor->sheet_name = $sheetName;
        $honor->save();

        return Action::message('File BOS Sukses diimport!');
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
            Number::make('Volume', 'volume')
                ->step(0.01)
                ->help('Default Volume Pekerjaan'),
            Currency::make('Harga Satuan', 'harga_satuan')

                ->help('Default Harga Satuan'),
            Number::make('Persentase Pajak', 'persen_pajak')
                ->step(0.01)
                ->help('Default Persentase Pajak'),
            Select::make('Kepka Mitra', 'kepka_mitra_id')
                ->rules('required')
                ->searchable()
                ->options(Helper::setOptionKepkaMitra($this->model->first()->tahun)),
        ];
    }
}
