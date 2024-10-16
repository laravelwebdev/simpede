<?php

namespace App\Nova\Actions;

use App\Helpers\Cetak;
use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Download extends Action
{
    use InteractsWithQueue, Queueable;

    protected $jenis;

    protected $title;

    public function __construct($jenis, $title = 'Unduh')
    {
        $this->jenis = $jenis;
        $this->title = $title;
    }

    public function name()
    {
        return $this->title;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $filename = Cetak::cetak($this->jenis, $models, $fields->filename, $fields->template);

        return Action::redirect(route('dump-download', [
            'filename' => $filename,
        ]));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Nama File', 'filename')
                ->rules('required', 'alpha_dash:ascii')
                ->help('tanpa extensi file')
                ->default(fn () => uniqid()),
            Select::make('Template')
                ->rules('required')
                ->displayUsingLabels()
                ->options(Helper::setOptionTemplate($this->jenis)),
        ];
    }
}
