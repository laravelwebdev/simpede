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

class EditRekening extends Action
{
    use InteractsWithQueue, Queueable;

    public $confirmButtonText = 'Edit';

    public $name = 'Edit Rekening';

    protected $jenis;

    public function __construct($jenis)
    {
        $this->jenis = $jenis;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        if ($this->jenis == 'mitra') {
            $mitra = Mitra::where('id', $model->mitra_id)->first();
            $mitra->rekening = $fields->rekening;
            $mitra->save();
        }
        if ($this->jenis == 'pegawai') {
            $user = User::where('id', $model->user_id)->first();
            $user->rekening = $fields->rekening;
            $user->save();
        }

        return Action::message('Edit Rekening Berhasil!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Rekening', 'rekening')
                ->rules('required')->help('Contoh Penulisan Rekening: BRI 123456788089'),
        ];
    }
}
