<?php

namespace App\Imports;

use App\Models\DaftarHonor;
use App\Models\Mitra;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DaftarHonorImport implements ToCollection, WithMultipleSheets, WithHeadingRow
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (strlen($row[0]) == 16) {
                $daftar = new DaftarHonor;
                $daftar->nik = $row[0];
                $daftar->nama = Mitra::cache()->get('all')->where('nik', $row[0])->first()->nama;
                $daftar->jumlah = $row[5];
                $daftar->satuan = $row[6];
                $daftar->bruto = $row[5] * $row[6];
                $daftar->pajak = round(($row[5] * $row[6] * $row[7]) / 100, 0, PHP_ROUND_HALF_UP);
                $daftar->netto = ($row[5] * $row[6]) - round(($row[5] * $row[6] * $row[7]) / 100, 0, PHP_ROUND_HALF_UP);
                $daftar->rekening = Mitra::cache()->get('all')->where('nik', $row[0])->first()->rekening ?? '';
                $daftar->honor_survei_id = $this->id[0];
                $daftar->bulan = $this->id[1];
                $daftar->jenis = $this->id[2];
                $daftar->save();
            }
        }
    }

    public function sheets(): array
    {
        return [0 => $this];
    }
}
