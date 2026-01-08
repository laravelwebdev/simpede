<?php

namespace App\Nova\Actions;

use App\Helpers\HtmlGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Markwalet\NovaModalResponse\ModalResponse;

class DetailPulsaMitra extends Action
{
    use InteractsWithQueue;
    use Queueable;

    public $withoutActionEvents = true;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();

        return ModalResponse::html(HtmlGenerator::detailPulsaMitra($model))
            ->title('Detail Penggantian Pulsa')->size('5xl');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [];
    }
}
