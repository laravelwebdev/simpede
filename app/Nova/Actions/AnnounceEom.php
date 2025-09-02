<?php

namespace App\Nova\Actions;

use App\Helpers\Fonnte;
use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class AnnounceEom extends Action
{
    use InteractsWithQueue;
    use Queueable;

    public $name = 'Umumkan di Grup Whatsapp';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $recipients = $fields->id;
        $pesan = '*[_Employee Of The Month_ Bulan '.Helper::BULAN[$model->bulan].' '.$model->tahun."]*\n\n🎉Selamat Kepada ".optional(Helper::getPegawaiByUserId($model->user_id))->name.' yang terpilih sebagai _Employee of the Month_ bulan '.Helper::BULAN[$model->bulan]."! Terima kasih atas dedikasi dan kerja kerasnya 👏🔥\nLink Sertifikat Penghargaan: \n".Storage::disk('arsip')->url($model->arsip_sertifikat)." \n\nTerimakasih ✨✨";
        $response = Fonnte::make()->sendWhatsAppMessage($recipients, $pesan);

        return $response['status'] ? Action::message('Pesan berhasil dikirim.') : Action::danger('Pesan gagal dikirim.');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Select::make('WA Group', 'id')
                ->options(Helper::setOptionsWaGroup())
                ->searchable()
                ->rules('required')
                ->displayUsingLabels(),
        ];
    }
}
