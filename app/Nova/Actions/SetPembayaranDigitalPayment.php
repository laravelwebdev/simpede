<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SetPembayaranDigitalPayment extends Action
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
        if ($model) {
            if ($fields->tanggal_pembayaran < $model->tanggal_transaksi) {
                return ActionResponse::danger('Tanggal pembayaran tidak boleh kurang dari tanggal transaksi.');
            }

            $model->update([
                'nomor' => $fields->nomor,
                'tanggal_pembayaran' => $fields->tanggal_pembayaran,
            ]);
        }

        return ActionResponse::message('Pembayaran digital telah diperbarui.');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Text::make('Nomor SP2D/SPBy', 'nomor')
                ->rules('required', 'max:50')
                ->help('Masukkan nomor SP2D untuk pembayaran KKP atau Nomor SPBY untuk CMS'),
            Date::make('Tanggal Pembayaran', 'tanggal_pembayaran')
                ->rules('required', 'after_or_equal:tanggal_transaksi')
                ->help('Masukkan tanggal SP2D untuk pembayaran KKP atau tanggal Persetujuan SPBy oleh PPK untuk CMS'),
        ];
    }
}
