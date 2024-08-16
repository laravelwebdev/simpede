<?php

namespace App\Imports;

use App\Models\Mitra;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MitrasImport implements ToModel, WithHeadingRow
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
        return new Mitra([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'rekening' => $row['rekening'],
            'tahun' => $this->tahun,
        ]);
    }
}
