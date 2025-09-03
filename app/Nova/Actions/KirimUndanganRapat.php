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

class KirimUndanganRapat extends Action
{
    use InteractsWithQueue;
    use Queueable;

    public $name = 'Kirim Undangan Rapat';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $recipients = $fields->id;
        $pesan = "*[Undangan Rapat]*\n\nYth. ".$model->tujuan."\n\nSehubungan dengan akan dilaksanakannya ".$model->tema.", Kami mengundang Bapak/Ibu untuk dapat berhadir :\n\npada hari/tanggal	:	".Helper::terbilanghari($model->tanggal_rapat).', '.Helper::terbilangTanggal($model->tanggal_rapat)."\nwaktu 	:	".Helper::formatJam($model->mulai)."  – selesai\ntempat	:	".$model->tempat."\nagenda	:	".$model->agenda."\n\nLink Undangan: \n".Storage::disk('arsip')->url(urlencode($model->signed_undangan))." \n\nTerimakasih ✨✨";
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
