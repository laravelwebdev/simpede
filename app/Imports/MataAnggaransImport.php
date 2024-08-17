<?php

namespace App\Imports;

use App\Models\MataAnggaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MataAnggaransImport implements ToModel, WithHeadingRow
{

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MataAnggaran([
            'mak' => $row['mak'],
        ]);
    }
}
