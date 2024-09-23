<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\DaftarHonorMitra;
use App\Models\Mitra;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class DaftarHonorMitraImport implements ToCollection, WithMultipleSheets, WithHeadingRow
{
    protected $id;
    protected $jenis;
    protected $bulan;
    protected $kepka_mitra_id;

    public function __construct($id, $bulan, $jenis, $kepka_mitra_id)
    {
        $this->id = $id;
        $this->jenis = $jenis;
        $this->bulan = $bulan;
        $this->kepka_mitra_id = $kepka_mitra_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (strlen($row['NIP Lama']) == 16) {
                $mitra_id = Helper::getPropertyFromCollection(Mitra::cache()->get('all')->where('nik', $row['NIP Lama'])->where('kepka_mitra_id', $this->kepka_mitra_id)->first(),'id');
                DaftarHonorMitra::updateOrCreate(
                    [
                        'mitra_id' => $mitra_id,
                        'honor_kegiatan_id' => $this->id,
                        'bulan' => $this->bulan,
                        'jenis' => $this->jenis,
                    ],
                    [
                        'volume' => $row['Volume'],
                        'harga_satuan' => $row['HargaSatuan'],
                        'persen_pajak' =>  $row['PersentasePajak'],
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }

    public function sheets(): array
    {
        return [0 => $this];
    }
}
