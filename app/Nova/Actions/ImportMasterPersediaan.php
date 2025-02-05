<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\BarangPersediaan;
use App\Models\MasterPersediaan;
use App\Models\PersediaanMasuk;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportMasterPersediaan extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Master Persediaan';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $id_persediaan_masuk = null;
        if ($fields->reset_saldo) {
            $persediaan_masuk = new PersediaanMasuk;
            $persediaan_masuk->tanggal_dokumen = session('year') - 1 .'-12-31';
            $persediaan_masuk->tanggal_buku = session('year') - 1 .'-12-31';
            $persediaan_masuk->rincian = 'Saldo Awal';
            $persediaan_masuk->save();
            $id_persediaan_masuk = $persediaan_masuk->id;
        }
        MasterPersediaan::cache()->disable();
        MasterPersediaan::query()->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) use ($fields, $id_persediaan_masuk) {
            $masterPersediaan = MasterPersediaan::firstOrNew(
                [
                    'kode' => $row['kode'],
                ]
            );
            $masterPersediaan->barang = $row['barang'];
            $masterPersediaan->satuan = $row['satuan'];
            $masterPersediaan->updated_at = now();

            $masterPersediaan->save();
            $masterPersediaanId = $masterPersediaan->id;
            if ($fields->reset_saldo && $row['saldo'] > 0) {
                $persediaan = new BarangPersediaan;
                $persediaan->volume = $row['saldo'];
                $persediaan->tanggal_transaksi = session('year') - 1 .'-12-31';
                $persediaan->master_persediaan_id = $masterPersediaanId;
                $persediaan->barang_persediaanable_id = $id_persediaan_masuk;
                $persediaan->barang_persediaanable_type = \App\Models\PersediaanMasuk::class;
                $persediaan->save();
            }
        });
        $ids = MasterPersediaan::where('updated_at', null)->get()->pluck('id');
        MasterPersediaan::destroy($ids);
        MasterPersediaan::cache()->enable();
        MasterPersediaan::cache()->updateAll();

        return Action::message('Master Persediaan sukses diimport!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            File::make('File')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')
                ->help('<a href = "'.Storage::disk('templates')->url(Helper::getTemplatePathByName('Template Import Master Persediaan')['filename']).'">Unduh Template</a>'),
            Boolean::make('Reset Saldo Awal?', 'reset_saldo')
                ->default(false)
                ->help('Hanya centang jika Anda mengerti apa yang dilakukan. Hanya dipakai pada saat awal implementasi Aplikasi'),
        ];
    }
}
