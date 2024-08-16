<?php

namespace App\Imports;

use App\Models\KodeArsip;
use App\Models\MataAnggaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MataAnggaransImport implements ToModel, WithHeadingRow
{
    protected $tahun;

    function __construct($tahun) {
        $this->tahun = $tahun;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MataAnggaran([
            'mak' => $row['mak'],
            'tahun' => $this->tahun,
        ]);
    }
}
