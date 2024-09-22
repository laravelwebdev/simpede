<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Imports\DaftarHonorMitraImport;
use App\Models\DaftarHonorMitra;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportDaftarHonorMitra extends Action
{
    use InteractsWithQueue, Queueable;
    public $name = 'Import dari BOS';

    protected $tahun;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        if ($model->bulan == '') {
            return Action::danger('Lengkapi Keterangan Honor Survei sebelum import file BOS');
        }
        DaftarHonorMitra::where('honor_kegiatan_id', $model->id)->delete();
        Excel::import(new DaftarHonorMitraImport($model->id, $model->bulan, $model->jenis, $fields->kepka_mitra_id), $fields->file);
        $model->status = 'import';
        $model->save();

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
                ->options(Helper::setOptionKepkaMitra($this->tahun)),
        ];
    }
}
