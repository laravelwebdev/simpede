<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\DaftarKegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SetStatusPostingKonten extends Action
{
    use InteractsWithQueue;
    use Queueable;

    public $name = 'Ubah Status';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->status = $fields->status;
            if ($fields->status === 'Selesai' && isset($fields->link)) {
                $model->link = $fields->link;
            }
            $model->save();
            if ($fields->status === 'Selesai' || $fields->status === 'Dibatalkan') {
                $daftarKegiatan = DaftarKegiatan::where('posting_konten_id', $model->id);
                $daftarKegiatan->update(['status' => 'sent']);
                foreach ($daftarKegiatan->get() as $kegiatan) {
                    $kegiatan->daftarReminder()->update(['status' => 'sent']);
                }
            }
        }

        return Action::message('Status berhasil diubah menjadi '.$fields->status);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Select::make('Status')
                ->options(Helper::STATUS_KONTEN)
                ->displayUsingLabels(),
            Text::make('Link')
                ->hide()
                ->dependsOn(['status'], function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->status === 'Selesai') {
                        $field->show();
                        $field->rules('required', 'url', 'max:255');
                    }
                }),
        ];
    }
}
