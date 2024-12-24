<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Models\JenisBelanja;
use App\Models\TargetSerapanAnggaran;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Nova;
use Whitespacecode\TableCard\Table\Cell;
use Whitespacecode\TableCard\Table\Row;
use Whitespacecode\TableCard\TableCard;

class RealisasiPerJenisBelanja extends TableCard
{
    public function __construct()
    {
        $header = collect(['Jenis Belanja', 'Target', 'Realisasi', 'Persen', 'Selisih']);
        $this->viewAll([
            'label' => 'Target Serapan Anggaran yang tercantum adalah target pada akhir triwulan berjalan',
            'link' => Nova::path().'/resources/realisasi-anggarans/lens/realisasi-anggaran', //URL to navigate when the link is clicked
            'position' => 'top', //(Possible values `top` - `bottom`)
            'style' => 'button', //(Possible values `link` - `button`)
        ]);

        $this->title('Target Serapan Anggaran Per Jenis Belanja Periode ini');
        $dipaId = Helper::getPropertyFromCollection(Dipa::cache()->get('all')->where('tahun', session('year'))->first(), 'id');
        $bulan = date('m');

        $datas = DB::table('mata_anggarans')
            ->selectRaw('jenis_belanja, SUM(nilai) as realisasi')
            ->join('jenis_belanjas', function ($join) use ($dipaId) {
                $join->on('jenis_belanjas.kode', '=', 'mata_anggarans.jenis_belanja')
                    ->where('jenis_belanjas.dipa_id', $dipaId);
            })
            ->leftJoin('realisasi_anggarans', function ($join) use ($dipaId) {
                $join->on('realisasi_anggarans.mata_anggaran_id', '=', 'mata_anggarans.id')
                    ->where('realisasi_anggarans.dipa_id', $dipaId);
            })
            ->join('daftar_sp2ds', 'realisasi_anggarans.daftar_sp2d_id', '=', 'daftar_sp2ds.id')
            ->whereMonth('tanggal_sp2d', '<=', $bulan)
            ->orWhereNull('tanggal_sp2d')
            ->groupBy('jenis_belanja')
            ->orderBy('jenis_belanja')
            ->get()
            ->transform(function ($item) use ($dipaId, $bulan) {
                $targetSerapan = TargetSerapanAnggaran::cache()->get('all')
                    ->where('bulan', $bulan)
                    ->where('jenis_belanja_id', JenisBelanja::cache()->get('all')
                        ->where('kode', $item->jenis_belanja)
                        ->where('dipa_id', $dipaId)
                        ->first()->id)
                    ->first()->nilai;

                $total = DB::table('mata_anggarans')
                    ->where('jenis_belanja', $item->jenis_belanja)
                    ->where('dipa_id', $dipaId)
                    ->sum(DB::raw('total - blokir'));

                $item->target = round(($total / 100) * $targetSerapan, 0);
                $item->realisasi = $item->realisasi ?? 0;
                $item->selisih = $item->realisasi - $item->target;
                $item->persen = round(($item->realisasi / $item->target) * 100, 2);
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
                Cell::make($data->persen)->class('text-right'),
                Cell::make(Helper::formatUang($data->selisih))->class('text-right'),
            );
        })->toArray());
    }
}
