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
                $daftar = new DaftarHonorMitra;
                $daftar->nik = $row['NIP Lama'];
                $daftar->nama = Mitra::cache()->get('all')->where('nik', $row['NIP Lama'])->where('kepka_mitra_id', $this->kepka_mitra_id)->first()->nama;
                $daftar->jumlah = $row['Volume'];
                $daftar->satuan = $row['HargaSatuan'];
                $daftar->bruto = $row['Volume'] * $row['HargaSatuan'];
                $daftar->pajak = round(($row['Volume'] * $row['HargaSatuan'] * $row['PersentasePajak']) / 100, 0, PHP_ROUND_HALF_UP);
                $daftar->netto = ($row['Volume'] * $row['HargaSatuan']) - round(($row['Volume'] * $row['HargaSatuan'] * $row['PersentasePajak']) / 100, 0, PHP_ROUND_HALF_UP);
                $daftar->rekening = Mitra::cache()->get('all')->where('nik', $row['NIP Lama'])->first()->rekening ?? '';
                $daftar->honor_kegiatan_id = $this->id;
                $daftar->bulan = $this->bulan;
                $daftar->jenis = $this->jenis;
                $daftar->save();
            }
        }
    }

    public function sheets(): array
    {
        return [0 => $this];
    }
}
