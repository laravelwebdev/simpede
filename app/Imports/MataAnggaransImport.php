<?php

namespace App\Imports;

use App\Models\KamusAnggaran;
use App\Models\MataAnggaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class MataAnggaransImport implements ToCollection, WithHeadingRow
{
    protected $satker;
    protected $wilayah;
    protected $dipa_id;

    public function __construct($satker, $wilayah, $dipa_id)
    {
        $this->satker = $satker;
        $this->wilayah = $wilayah;
        $this->dipa_id = $dipa_id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $replaces[$this->satker.'.'] = '';
            $replaces['.'.$this->wilayah] = '';
            $anggaran = explode('||', $row['Kode'])[0];
            $mak = strtr($anggaran, $replaces);
            if ($mak) {
                KamusAnggaran::updateOrCreate(
                    [
                        'mak' => $mak,
                        'dipa_id' => $this->dipa_id,
                    ],
                    [
                        'detail' => $row['Program/ Kegiatan/ KRO/ RO/ Komponen'],
                        'updated_at' => now(),
                    ]
                );
            }
            if (strlen($mak) == 37) {
                MataAnggaran::updateOrCreate(
                    [
                        'mak' => substr($mak, 0, 35),
                        'dipa_id' => $this->dipa_id,
                    ],
                    [
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
