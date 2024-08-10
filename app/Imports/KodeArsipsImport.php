<?php

namespace App\Imports;

use App\Models\KodeArsip;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KodeArsipsImport implements ToModel, WithHeadingRow
{
    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new KodeArsip([
            'kode' => $row['kode'],
            'group' => $row['group'],
            'detail' => $row['detail'],
        ]);
    }
}
