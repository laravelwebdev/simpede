<?php

namespace App\Imports;

use App\Models\Mitra;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MitrasImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $mitra = New Mitra;
            $mitra->nik = $row['nik'];
            $mitra->nama = $row['nama'];
            $mitra->alamat = $row['alamat'];
            $mitra->rekening = $row['rekening'];
            $mitra->save();
        }
    }
}
