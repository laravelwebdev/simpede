<?php

namespace App\Nova\Actions;

use App\Models\BarangPersediaan;
use App\Models\Mitra;
use App\Models\SpesifikasiKerangkaAcuan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
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
            ->where('barang_persediaanable_type', 'App\Models\PembelianPersediaan')
            ->delete();
        $speks =SpesifikasiKerangkaAcuan::where
        $barang = New BarangPersediaan;

        $barang->barang_persediaanable_id = $model->id;
        $barang->barang_persediaanable_type = 'App\Models\PembelianPersediaan';

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
