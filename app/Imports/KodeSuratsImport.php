<?php

namespace App\Imports;

use App\Models\KodeSurat;
use Maatwebsite\Excel\Concerns\ToModel;

class KodeSuratsImport implements ToModel
{
    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new KodeSurat([
            'kode'  => $row[0],
            'k1'    => $row[1],
            'k2'    => $row[2],
            'k3'    => $row[3],
            'k4'    => $row[4],
        ]);
    }
}
