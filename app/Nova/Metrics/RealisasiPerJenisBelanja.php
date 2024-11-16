<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Models\JenisBelanja;
use App\Models\TargetSerapanAnggaran;
use Illuminate\Support\Facades\DB;
use Whitespacecode\TableCard\Table\Cell;
use Whitespacecode\TableCard\Table\Row;
use Whitespacecode\TableCard\TableCard;

class RealisasiPerJenisBelanja extends TableCard
{
    public function __construct()
    {
        $header = collect(['Jenis Belanja', 'Target', 'Realisasi', 'Selisih']);

        $this->title('Target Serapan Anggaran Per Jenis Belanja Periode ini');
        $dipaId = Dipa::cache()->get("all")->where("tahun", session('year'))->first()->id;
        $bulan = date("m");

        $datas = DB::table("mata_anggarans")
            ->selectRaw("jenis_belanja, SUM(nilai) as realisasi")
            ->rightJoin("jenis_belanjas", "jenis_belanjas.kode", "=", "mata_anggarans.jenis_belanja")
            ->leftJoin("realisasi_anggarans", "realisasi_anggarans.mata_anggaran_id", "=", "mata_anggarans.id")
            ->where("mata_anggarans.dipa_id", $dipaId)
            ->whereMonth("tanggal_sp2d", "<=", $bulan)
            ->orWhereNull("tanggal_sp2d")
            ->groupBy("jenis_belanja")
            ->orderBy("jenis_belanja")
            ->get()
            ->transform(function ($item) use ($dipaId, $bulan) {
            $targetSerapan = TargetSerapanAnggaran::cache()->get("all")
                ->where("bulan", $bulan)
                ->where("jenis_belanja_id", JenisBelanja::cache()->get("all")
                ->where("kode", $item->jenis_belanja)
                ->where("dipa_id", $dipaId)
                ->first()->id)
                ->first()->nilai;

            $total = DB::table("mata_anggarans")
                ->where("jenis_belanja", $item->jenis_belanja)
                ->where("dipa_id", $dipaId)
                ->sum("total");

            $item->target = round(($total / 100) * $targetSerapan, 0);
            $item->realisasi = $item->realisasi ?? 0;
            $item->selisih = $item->realisasi - $item->target;
            $item->jenis_belanja = Helper::$jenis_belanja[$item->jenis_belanja];

            return $item;
            });

        $this->header($header->map(function ($value) {
            return ($value !== 'Jenis Belanja') ?
                Cell::make($value)->class('text-right pr-6') :
                Cell::make($value);
        })->toArray());

        $this->data($datas->map(function ($data) {
            return Row::make(
                Cell::make($data->jenis_belanja),
                Cell::make(Helper::formatUang($data->target))->class('text-right'),
                Cell::make(Helper::formatUang($data->realisasi))->class('text-right'),
                Cell::make(Helper::formatUang($data->selisih))->class('text-right'),
            );
        })->toArray());

    }
}
