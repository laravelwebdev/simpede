<?php

namespace App\Nova\Actions;

use App\Models\BarangPersediaan;
use App\Models\SpesifikasiKerangkaAcuan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class ImportBarangFromSpesifikasiKerangkaAcuan extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Impor dari KAK';

    /**
     * Perform the action on the given models.
     *'.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        BarangPersediaan::where('barang_persediaanable_id', $model->id)
            ->where('barang_persediaanable_type', \App\Models\PembelianPersediaan::class)
            ->delete();
        $speks = SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $model->kerangka_acuan_id)->get();
        foreach ($speks as $spek) {
            $barang = new BarangPersediaan;
            $barang->barang = $spek->rincian;
            $barang->satuan = $spek->satuan;
            $barang->volume = $spek->volume;
            $barang->harga_satuan = $spek->harga_satuan;
            $barang->total_harga = $spek->total_harga;
            $barang->barang_persediaanable_id = $model->id;
            $barang->barang_persediaanable_type = \App\Models\PembelianPersediaan::class;
            $barang->save();
        }

        return Action::message('Barang sukses diimport!');
    }

    /*'
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
        ];
    }
}
