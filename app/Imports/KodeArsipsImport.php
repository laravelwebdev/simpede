<?php

namespace App\Imports;

use App\Models\KodeArsip;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KodeArsipsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $kode = New KodeArsip;
            $kode->kode = $row['kode'];
            $kode->group = $row['group'];
            $kode->detail = $row['detail'];
            $kode->save();
        }
    }
}
