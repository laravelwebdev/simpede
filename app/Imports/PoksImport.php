<?php

namespace App\Imports;

use App\Models\Pok;
use Maatwebsite\Excel\Concerns\ToModel;

class PoksImport implements ToModel
{
    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Pok([
            'program'     => $row[0],
            'kegiatan'    => $row[1],
            'kro'    => $row[2],
            'ro'    => $row[3],
            'komponen'    => $row[4],
            'sub'    => $row[5],
            'akun'    => $row[6],
            'detail'    => $row[7],
            'volume'    => $row[8],
            'harga'    => $row[9],
            'jumlah'    => $row[10],
            'mak'    => $row[11],
            'revisi'    => $row[12],
            'realisasi'    => $row[13],
            'sisa'    => $row[14],
        ]);
    }
}
