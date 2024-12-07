<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\KakSp2d;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Http\Requests\NovaRequest;

class AttachSpm extends Action
{
    use InteractsWithQueue, Queueable;

    private $model;

    public $name = 'Tambahkan Nomor SPP';

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
         KakSp2d::where('kerangka_acuan_id', $model->id)->update(['updated_at' => null]);
            foreach ($fields->nomor_spp  as $nomor_spp) {
                $kakSp2d = KakSp2d::firstOrNew(
                    [
                        'kerangka_acuan_id' => $model->id,
                        'daftar_sp2d_id' => $nomor_spp,
                    ]
                );
               $kakSp2d->save();
            }
        $ids = KakSp2d::where('updated_at', null)->get()->pluck('id');
        KakSp2d::destroy($ids);
        return Action::message('SPP berhasil ditambahkan.');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            MultiSelect::make('Nomor SPP', 'nomor_spp')
                ->options(Helper::setOptionsNomorSpp($this->model->id, $this->model->dipa_id))
                ->rules('required'),
        ];
    }
}
