<?php

namespace App\Imports;

use App\Models\KamusAnggaran;
use App\Models\MataAnggaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MataAnggaransImport implements ToCollection, WithStartRow
{
    protected $satker;
    protected $wilayah;

    public function __construct($satker, $wilayah)
    {
        $this->satker = $satker;
        $this->wilayah = $wilayah;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $replaces[$this->satker.'.'] = '';
            $replaces['.'.$this->wilayah] = '';
            $anggaran = explode('||', $row[0])[0];
            $mak = strtr($anggaran, $replaces);
            $kamus_anggaran = new KamusAnggaran;
            $kamus_anggaran->mak = $mak;
            $kamus_anggaran->detail = $row[1];
            $kamus_anggaran->save();
            if (strlen($mak) == 37) {
                $mata_anggaran = new MataAnggaran;
                $mata_anggaran->mak = substr($mak, 0, 35);
                $mata_anggaran->save();
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
