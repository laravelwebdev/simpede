<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExportTemplateCmsBri extends Action
{
    use InteractsWithQueue, Queueable;

    protected $type;

    protected $kegiatan;

    public function __construct($kegiatan, $type = 'ft')
    {
        $this->type = $type;
        $this->kegiatan = $kegiatan;
    }

    public function name()
    {
        return 'Export Template CMS BRI MASS '.strtoupper($this->type);
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        //
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Rekening Bendahara', 'rekening_bendahara')
                ->default(config('satker.rekening'))
                ->rules('required'),
            Text::make('Remark', 'remark')
                ->rules('required')
                ->default('Honor '.$this->kegiatan),

        ];
    }
}
