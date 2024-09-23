<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Imports\DaftarHonorMitraImport;
use App\Models\DaftarHonorMitra;
use App\Models\HonorKegiatan;
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

    protected $model;

    public function __construct($honor_kegiatan_id)
    {
        $this->model = HonorKegiatan::where('id',$honor_kegiatan_id);
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
        Excel::import(new DaftarHonorMitraImport($honor->id, $honor->bulan, $honor->jenis_kontrak, $fields->kepka_mitra_id), $fields->file);
        DaftarHonorMitra::where('updated_at', null)->delete();
        $this->model->update(['status' =>'diubah']);
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
