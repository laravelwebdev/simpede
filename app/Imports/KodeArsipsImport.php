<?php

namespace App\Imports;

use App\Models\KodeArsip;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KodeArsipsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KodeArsip([
            'kode'  => $row['kode'],
            'k1'    => $row['k1'],
            'k2'    => $row['k2'],
            'k3'    => $row['k3'],
            'k4'    => $row['k4'],
        ]);
    }
}
