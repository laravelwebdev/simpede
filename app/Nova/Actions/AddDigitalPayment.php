<?php

namespace App\Nova\Actions;

use App\Models\DigitalPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddDigitalPayment extends Action
{
    use InteractsWithQueue, Queueable;

    public function name()
    {
        return 'Tambahkan Penggunaan Digital Payment';
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $kak = $models->first();
        $digitalPayment = new DigitalPayment;
        $digitalPayment->kerangka_acuan_id = $kak->id;
        $digitalPayment->save();

        return ActionResponse::visit('/resources/digital-payments/'.$digitalPayment->id.'/edit');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
        ];
    }
}
