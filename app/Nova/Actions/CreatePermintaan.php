<?php

namespace App\Nova\Actions;

use App\Models\Permintaan;
use Comodolab\Nova\Fields\Help\Help;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Textarea;

class CreatePermintaan extends Action
{
    use InteractsWithQueue, Queueable;
    public $confirmButtonText = 'Buat Permintaan';
    public $name = 'Buat Permintaan';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $permintaan = new Permintaan;
            $permintaan->tanggal = $fields->tanggal;
            $permintaan->rincian = $fields->rincian;
            $permintaan->program = $model->program;
            $permintaan->kegiatan = $model->kegiatan;
            $permintaan->kro = $model->kro;
            $permintaan->ro = $model->ro;
            $permintaan->komponen = $model->komponen;
            $permintaan->sub = $model->sub;
            $permintaan->akun = $model->akun;
            $permintaan->mak = $model->mak;
            $permintaan->detail = $model->id;
            $permintaan->volume = $model->volume;
            $permintaan->harga = $model->harga;
            $permintaan->jumlah = $model->jumlah;
            $permintaan->realisasi = $model->realisasi;
            $permintaan->sisa = $model->sisa;
            $permintaan->save();
        }

        return Action::push('/resources/permintaans/'.$permintaan->id.'/edit');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Help::warning('Perhatian!', 'Pastikan Tanggal Permintaan sebelum kegiatan dilaksanakan. Tanggal Permintaan tidak dapat diubah lagi'),
            Date::make('Tanggal Permintaan', 'tanggal')
                ->rules('required', 'before:tomorrow'),
            Help::info('Contoh rincian permintaan:', 'Pembayaran Honor......    Pembayaran Biaya Perjalanan Dinas dalam rangka...      Pengadaan Perlengkapan....'),
            Textarea::make('Rincian Permintaan', 'rincian')
                ->rules('required'),
        ];
    }
}
