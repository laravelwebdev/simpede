<?php

namespace App\Imports;

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
                DaftarHonorMitra::updateOrCreate(
                    [
                        'nik' => $row['NIP Lama'],
                        'honor_kegiatan_id' => $this->id,
                        'bulan' => $this->bulan,
                        'jenis' => $this->jenis,
                    ],
                    [
                        'nama' => Mitra::cache()->get('all')->where('nik', $row['NIP Lama'])->where('kepka_mitra_id', $this->kepka_mitra_id)->first()->nama,
                        'volume' => $row['Volume'],
                        'harga_satuan' => $row['HargaSatuan'],
                        'bruto' => $row['Volume'] * $row['HargaSatuan'],
                        'pajak' => round(($row['Volume'] * $row['HargaSatuan'] * $row['PersentasePajak']) / 100, 0, PHP_ROUND_HALF_UP),
                        'netto' => ($row['Volume'] * $row['HargaSatuan']) - round(($row['Volume'] * $row['HargaSatuan'] * $row['PersentasePajak']) / 100, 0, PHP_ROUND_HALF_UP),
                        'rekening' => Mitra::cache()->get('all')->where('nik', $row['NIP Lama'])->first()->rekening ?? '',
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
