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

class RencanaPenarikanPerJenisBelanja extends TableCard
{
    public function __construct()
    {
        $header = collect(['Jenis Belanja', 'Target', 'Realisasi', 'Deviasi', 'Persen Deviasi']);
        $this->viewAll([
            'label' => 'Bulan '.Helper::$bulan[date('m')], //Label for the link
            'link' => Nova::path().'/resources/realisasi-anggarans/lens/rencana-penarikan-dana', //URL to navigate when the link is clicked
            'position' => 'top', //(Possible values `top` - `bottom`)
            'style' => 'button', //(Possible values `link` - `button`)
        ]);

        $this->title('Monitoring Rencana Penarikan Dana');
        $dipaId = Dipa::cache()->get('all')->where('tahun', session('year'))->first()->id;
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
            ->whereMonth('tanggal_sp2d', $bulan)
            ->orWhereNull('tanggal_sp2d')
            ->groupBy('jenis_belanja')
            ->orderBy('jenis_belanja')
            ->get()
            ->transform(function ($item) use ($dipaId, $bulan) {

                $item->target = DB::table('mata_anggarans')
                    ->where('jenis_belanja', $item->jenis_belanja)
                    ->where('dipa_id', $dipaId)
                    ->sum('rpd_'.$bulan);
                $item->realisasi = $item->realisasi ?? 0;
                $item->selisih = $item->realisasi - $item->target;
                $item->jenis_belanja = Helper::$jenis_belanja[$item->jenis_belanja];
                $item->persen = abs(($item->target == 0) ? 0 : round(($item->selisih / $item->target) * 100, 2));

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
                Cell::make($data->persen)->class('text-right'),
            );
        })->toArray());

    }
}
