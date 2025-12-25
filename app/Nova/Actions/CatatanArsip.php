<?php

namespace App\Nova\Actions;

use App\Models\KerangkaAcuan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class CatatanArsip extends Action
{
    use InteractsWithQueue;
    use Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        KerangkaAcuan::where('id', $model->id)->update([
            'catatan' => $fields->catatan,
        ]);
        if (empty($fields->catatan)) {
            KerangkaAcuan::where('id', $model->id)->update([
                'status_arsip' => 'Berkas Lengkap',
            ]);
        }

        return Action::message('Catatan arsip berhasil disimpan.');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Textarea::make('Catatan', 'catatan')
                ->help('Isi hanya jika ada arsip yang kurang atau tidak sesuai. Biarkan kosong jika berkas sudah sesuai.'),
        ];
    }
}
