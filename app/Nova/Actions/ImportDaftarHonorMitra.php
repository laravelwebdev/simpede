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
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;
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
        $mitras = Mitra::cache()->get('all')->where('kepka_mitra_id', $fields->kepka_mitra_id)->keyBy('nik');
        ! $fields->template ?
        (new FastExcel)->sheet(2)->import($fields->file, function ($row) use ($honor, $fields, $mitras) {
            if (strlen($row['nip']) == 16) {
                $mitra = $mitras->get($row['nip']);
                $mitra_id = $mitra ? $mitra->id : null;
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
        })
        :
        (new FastExcel)->sheet(1)->import($fields->file, function ($row) use ($honor, $mitras) {
            if (strlen($row['NIP Lama']) == 16) {
                $mitra = $mitras->get($row['NIP Lama']);
                $mitra_id = $mitra ? $mitra->id : null;
                $daftarHonorMitra = DaftarHonorMitra::firstOrNew(
                    [
                        'mitra_id' => $mitra_id,
                        'honor_kegiatan_id' => $honor->id,
                    ]
                );

                $daftarHonorMitra->volume_realisasi = $row['Volume'];
                $daftarHonorMitra->volume_target = $row['Volume'];
                $daftarHonorMitra->harga_satuan = $row['HargaSatuan'];
                $daftarHonorMitra->persen_pajak = $row['PersentasePajak'];
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
            Boolean::make('Template Terisi', 'template')
                ->default(false)
                ->help('Centang jika file BOS yang diupload sudah terisi data'),
            Number::make('Volume', 'volume')
                ->step(1)
                ->rules('nullable', 'bail', 'lte:65535')
                ->help('Default Volume Pekerjaan'),
            Numeric::make('Harga Satuan', 'harga_satuan')
                ->rules('nullable', 'bail',	'lte:16777215')
                ->help('Default Harga Satuan'),
            Number::make('Persentase Pajak', 'persen_pajak')
                ->step(0.01)
                ->max(100)
                ->min(0)
                ->rules('gte:0', 'lte:100')
                ->help('Default Persentase Pajak'),
            Select::make('Kepka Mitra', 'kepka_mitra_id')
                ->rules('required')
                ->searchable()
                ->options(Helper::setOptionKepkaMitra($this->model->first()->tahun)),
        ];
    }
}
