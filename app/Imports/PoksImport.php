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
            'id' => $row[0],
            'program'     => $row[1],
            'kegiatan'    => $row[2],
            'kro'    => $row[3],
            'ro'    => $row[4],
            'komponen'    => $row[5],
            'sub'    => $row[6],
            'akun'    => $row[7],
            'detail'    => $row[8],
            'volume'    => $row[9],
            'harga'    => $row[10],
            'jumlah'    => $row[11],
            'mak'    => $row[12],
            'revisi'    => $row[13],
            'realisasi'    => $row[14],
            'sisa'    => $row[15],
        ]);
    }
}
