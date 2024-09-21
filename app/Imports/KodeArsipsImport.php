<?php

namespace App\Imports;

use App\Models\KodeArsip;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KodeArsipsImport implements ToCollection, WithHeadingRow
{
    protected $tata_naskah_id;

    public function __construct($tata_naskah_id)
    {
        $this->tata_naskah_id = $tata_naskah_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            KodeArsip::updateOrCreate(
                [
                    'detail' => $row['detail'],
                    'tata_naskah_id' => $this->tata_naskah_id,
                ],
                [
                    'detail' => $row['detail'],                    
                    'kode' => $row['kode'],
                    'group' => $row['group'],
                    'updated_at' => now(),
                ]
            );
        }
    }
}
