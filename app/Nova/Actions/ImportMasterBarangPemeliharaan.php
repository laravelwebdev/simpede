<?php

namespace App\Nova\Actions;

use App\Models\MasterBarangPemeliharaan;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportMasterBarangPemeliharaan extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Import Master Barang Pemeliharaan';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        MasterBarangPemeliharaan::cache()->disable();
        MasterBarangPemeliharaan::query()->update(['updated_at' => null]);
        (new FastExcel)->import($fields->file, function ($row) {
            if (
                ! empty($row['Kode Barang']) &&
                ! empty($row['No PSP']) &&
                ($row['Kondisi'] == 'Baik' || $row['Kondisi'] == 'Rusak Ringan') &&
                substr($row['Kode Barang'], 0, 7) != '6010102'
            ) {
                $MasterBarangPemeliharaan = MasterBarangPemeliharaan::firstOrNew(
                    [
                        'kode_barang' => $row['Kode Barang'],
                        'nup' => $row['NUP'],
                    ]
                );
                $MasterBarangPemeliharaan->nama_barang = $row['Nama Barang'];
                $MasterBarangPemeliharaan->merk = $row['Nama'];
                $MasterBarangPemeliharaan->nopol = $row['No Polisi'];
                $MasterBarangPemeliharaan->kondisi = $row['Kondisi'];
                $MasterBarangPemeliharaan->lokasi = $row['Lokasi Ruang'];
                $MasterBarangPemeliharaan->updated_at = now();

                $MasterBarangPemeliharaan->save();
            }
        });
        $ids = MasterBarangPemeliharaan::where('updated_at', null)->get()->pluck('id');
        MasterBarangPemeliharaan::destroy($ids);
        MasterBarangPemeliharaan::cache()->enable();
        MasterBarangPemeliharaan::cache()->update('all');

        return Action::message('Master Barang Pemeliharaan sukses diimport!');
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
                ->acceptedTypes('.xlsx')->help('Data akan diperbaharui dengan data baru'),
            Heading::make('File excel diambil dari Hasil Export Aplikasi SIMAN menu Master Aset - Daftar Aset Aktif'),
        ];
    }
}
