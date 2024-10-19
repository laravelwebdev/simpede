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
use Laravel\Nova\Fields\File;
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
        $honor = $this->model->first();
        DaftarHonorMitra::where('honor_kegiatan_id', $honor->id)->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) use ($honor, $fields) {
            if (strlen($row['NIP Lama']) == 16) {
                $mitra_id = Helper::getPropertyFromCollection(Mitra::cache()->get('all')->where('nik', $row['NIP Lama'])->where('kepka_mitra_id', $fields->kepka_mitra_id)->first(), 'id');
                $daftarHonorMitra = DaftarHonorMitra::firstOrNew(
                    [
                        'mitra_id' => $mitra_id,
                        'honor_kegiatan_id' => $honor->id,
                    ]
                );

                $daftarHonorMitra->volume = $row['Volume'] ?: 0;
                $daftarHonorMitra->harga_satuan = $row['HargaSatuan'] ?: 0;
                $daftarHonorMitra->persen_pajak = $row['PersentasePajak'] ?: 0;
                $daftarHonorMitra->updated_at = now();

                $daftarHonorMitra->save();
            }
        });
        $ids = DaftarHonorMitra::where('updated_at', null)->get()->pluck('id');
        DaftarHonorMitra::destroy($ids);    

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
            Select::make('Kepka Mitra', 'kepka_mitra_id')
                ->rules('required')
                ->options(Helper::setOptionKepkaMitra($this->model->first()->tahun)),
        ];
    }
}
