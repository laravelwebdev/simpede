<?php

namespace App\Nova\Actions;

use App\Models\Mitra;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class EditTarget extends Action
{
    use InteractsWithQueue, Queueable;

    public $confirmButtonText = 'Edit';

    public $name = 'Edit Target';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $model->volume_target = $fields->target;
        if ($model->volume_realisasi != $fields->target) {
            $model->status_realisasi = $model->volume_realisasi < $fields->target 
            ? 'Selesai Tidak Sesuai Target' 
            : 'Selesai Melebihi Target';
        } else {
            $model->status_realisasi = 'Selesai Sesuai Target';
        }
        $model->save();


        return Action::message('Edit Target Berhasil!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Target')
                ->rules('required')->help('Target yang ditetapkan dalam kontrak'),
        ];
    }
}
