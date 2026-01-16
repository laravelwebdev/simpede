<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\SusenasHarga;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportRentangHarga extends DestructiveAction
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
        SusenasHarga::query()->delete();
        (new FastExcel)->import($fields->file, function ($line) {
            return SusenasHarga::create([
                'no_urut' => $line['Nomor Urut Komoditas'],
                'nama' => $line['Komoditas'],
                'satuan' => $line['Satuan'],
                'harga1' => $line['Harga Minimum'],
                'harga2' => $line['Harga Maksimum'],
                'fixed' => $line['Digit Pembulatan'],
            ]);
        });

        return Action::message('Rentang Harga sukses diimport!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            File::make('File')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePathByName('Template Import Rentang Harga')['filename']).'">Unduh Template</a>'),

        ];
    }
}
