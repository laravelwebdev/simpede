<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarPulsaMitra;
use App\Models\Mitra;
use App\Models\PulsaKegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportDaftarPulsaMitra extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import dari BOS';

    protected $model;

    public function __construct($pulsa_kegiatan_id)
    {
        $this->model = PulsaKegiatan::where('id', $pulsa_kegiatan_id);
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $pulsa = $this->model->first();
        DaftarPulsaMitra::where('pulsa_kegiatan_id', $pulsa->id)->update(['updated_at' => null]);
        $mitras = Mitra::cache()->get('all')->where('kepka_mitra_id', $fields->kepka_mitra_id)->keyBy('nik');
        (new FastExcel)->sheet(2)->import($fields->file, function ($row) use ($pulsa, $fields, $mitras) {
            if (strlen($row['nip']) == 16) {
                $mitra = $mitras->get($row['nip']);
                $mitra_id = $mitra ? $mitra->id : null;
                $daftarPulsaMitra = DaftarPulsaMitra::firstOrNew(
                    [
                        'mitra_id' => $mitra_id,
                        'pulsa_kegiatan_id' => $pulsa->id,
                    ]
                );

                $daftarPulsaMitra->volume = ! empty($fields->volume) ? $fields->volume : 0;
                $daftarPulsaMitra->nominal = ! empty($fields->nominal) ? $fields->nominal : 0;
                $daftarPulsaMitra->harga = ! empty($fields->harga) ? $fields->harga : 0;
                $daftarPulsaMitra->updated_at = now();

                $daftarPulsaMitra->save();
            }
        });

        $ids = DaftarPulsaMitra::where('updated_at', null)->get()->pluck('id');
        DaftarPulsaMitra::destroy($ids);

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
                ->step(1)
                ->rules('nullable', 'bail', 'lte:65535')
                ->help('Default Volume Per Satuan'),
            Numeric::make('Nominal', 'nominal')
                ->rules('nullable', 'bail', 'lte:16777215')
                ->help('Default Nominal Pulsa'),
            Numeric::make('Harga Pulsa', 'harga')
                ->rules('nullable', 'bail', 'lte:16777215')
                ->help('Default Harga Pulsa'),
            Select::make('Kepka Mitra', 'kepka_mitra_id')
                ->rules('required')
                ->searchable()
                ->options(Helper::setOptionKepkaMitra(session('year'))),
        ];
    }
}
