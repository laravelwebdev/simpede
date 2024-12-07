<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
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
  throw_if(true, $fields->nomor_spp[0]);

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
