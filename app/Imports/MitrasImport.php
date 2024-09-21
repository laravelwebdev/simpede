<?php

namespace App\Imports;

use App\Models\Mitra;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class MitrasImport implements ToCollection, WithHeadingRow
{
    protected $kepka_mitra_id;

    
    public function __construct($kepka_mitra_id)
    {
        $this->kepka_mitra_id = $kepka_mitra_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row['Status Seleksi (1=Terpilih, 2=Tidak Terpilih)'] == 1)
            Mitra::updateOrCreate(
                [
                    'nik' => $row['NIK'],
                    'kepka_mitra_id' => $this->kepka_mitra_id,
                ],
                [
                    
                    'nama' => $row['Nama'],
                    'email' => $row['Email'],
                    'alamat' => $row['Alamat Detail'],
                    'tanggal_lahir' => Carbon::createFromFormat('d/m/Y',$row['Tanggal Lahir (dd/mm/yyyy)']),
                    'npwp' => $row['NPWP'],
                ]
            );



        }
    }
}
