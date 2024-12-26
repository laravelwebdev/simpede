<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\RateTranslok;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportRateTranslok extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Rate Translok';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        RateTranslok::cache()->disable();
        RateTranslok::where('sk_translok_id', $model->id)->where('type', $fields->type)->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) use ($model, $fields) {
            switch ($fields->type) {
                case '1':
                    $asal = Helper::getPropertyFromCollection(Helper::getMasterWilayahByKode($row['Asal Kabupaten'].'000'), 'id');
                    $tujuan = Helper::getPropertyFromCollection(Helper::getMasterWilayahByKode($row['Tujuan Kecamatan']), 'id');
                    break;
                case '2':
                    $asal = Helper::getPropertyFromCollection(Helper::getMasterWilayahByKode($row['Asal Kabupaten'].'000'), 'id');
                    $tujuan = Helper::getPropertyFromCollection(Helper::getMasterWilayahByKode($row['Tujuan Desa']), 'id');
                    break;

                default:
                    $asal = Helper::getPropertyFromCollection(Helper::getMasterWilayahByKode($row['Asal Kecamatan']), 'id');
                    $tujuan = Helper::getPropertyFromCollection(Helper::getMasterWilayahByKode($row['Tujuan Desa']), 'id');
                    break;
            }

            $rateTranslok = RateTranslok::firstOrNew(
                [
                    'type' => $fields->type,
                    'sk_translok_id' => $model->id,
                    'asal_master_wilayah_id' => $asal,
                    'tujuan_master_wilayah_id' => $tujuan,
                ]
            );
            $rateTranslok->rate = $row['Nilai'];
            $rateTranslok->updated_at = now();

            $rateTranslok->save();
        });
        $ids = RateTranslok::where('updated_at', null)->get()->pluck('id');
        RateTranslok::destroy($ids);
        RateTranslok::cache()->enable();
        RateTranslok::cache()->updateAll();

        return Action::message('Rate Translok '.Helper::$translok_type[$fields->type].' sukses diimport!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Tipe', 'type')
                ->rules('required')
                ->options(Helper::$translok_type),
            File::make('File')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('Template diunduh dari web iplan BPS'),
        ];
    }
}
