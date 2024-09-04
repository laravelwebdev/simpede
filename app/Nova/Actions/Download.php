<?php

namespace App\Nova\Actions;

use App\Helpers\Cetak;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class Download extends Action
{
    use InteractsWithQueue, Queueable;

    protected $jenis;
    protected $title;

    public function __construct($jenis , $title = 'Unduh')
    {
        $this->jenis = $jenis;
        $this->title = $title;
    }

    public function name ()
    {
        return $this->title;
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $filename = Cetak::cetak($this->jenis, $model->id);
        return ActionResponse::download($filename, Storage::disk($this->jenis)->url($filename));
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
