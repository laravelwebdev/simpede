<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class UbahStatusRekap extends Action
{
    use InteractsWithQueue;
    use Queueable;

    private $jenis;

    public function __construct($jenis = 'bos')
    {
        $this->jenis = $jenis;
    }

    public function name(): string
    {
        if ($this->jenis === 'bos') {
            return 'Ubah Status Rekap BOS';
        }

        return 'Ubah Status Pencatatan Sirup';
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        Model::withoutEvents(function () use ($fields, $models) {
            foreach ($models as $model) {
                if ($this->jenis === 'bos') {
                    $model->rekap_bos = $fields->rekap_bos;
                } else {
                    $model->rekap_sirup = $fields->rekap_sirup;
                }
                $model->save();
            }
        });
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        $fields = [];
        if ($this->jenis === 'bos') {
            $fields[] = Boolean::make('Rekap BOS', 'rekap_bos')
                ->help('Centang jika sudah melakukan rekap di BOS')
                ->rules('required');
        } else {
            $fields[] = Boolean::make('Pencatatan Sirup', 'rekap_sirup')
                ->help('Centang jika sudah melakukan pencatatan di Sirup atau bukan pengadaan non tender')
                ->rules('required');
        }

        return $fields;
    }
}
