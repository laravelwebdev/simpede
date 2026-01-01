<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\Dipa;
use Illuminate\Support\Carbon;
use Laravel\Nova\Nova;
use Laravelwebdev\Table\Table;
use Laravelwebdev\Table\Table\Cell;
use Laravelwebdev\Table\Table\Row;

class MonitoringUpPerJenis extends Table
{
    public function __construct()
    {
        $tglNihil = Dipa::cache()->get('all')->where('tahun', session('year'))->first()?->tanggal_nihil;
        $latestUp = Helper::getLatestUp(session('year'));
        $latestGup = Helper::getLatestGup(session('year'));
        $latestTup = Helper::getLatestTup(session('year'));

        $gup = $latestUp ? Helper::hitungPeriodeGup($latestGup?->tanggal) : null;
        $tup = $latestUp ? Helper::hitungPeriodeGup($latestTup?->tanggal) : null;

        $nilaiGup = $latestUp?->nilai ?? 0;
        $hariGup = $gup ? floor(now()->diffInDays($gup['awal'], true)) : 0;

        $minGup = $gup
            ? ceil(($hariGup / $gup['hari']) * $nilaiGup)
            : null;

        if ($minGup !== null) {
            $minGup = $minGup < 0.5 * $nilaiGup ? 0.5 * $nilaiGup
                     : ($minGup > $nilaiGup ? $nilaiGup
                     : $minGup);
        }

        $this->viewAll([
            'label' => Helper::terbilangTanggal(session('year') < now()->year ? Carbon::parse((session('year')) . '-12-31') : now()),
            'link' => Nova::path().'/resources/uang-persediaans/lens/monitoring-up',
            'position' => 'top',
            'style' => 'button',
        ]);

        $this->title('Monitoring UP/TUP');

        $this->header([
            Cell::make('Jenis'),
            Cell::make('Deadline GUP/GTUP'),
            Cell::make('Jumlah Minimal jika SP2D hari ini')->class('text-right'),
        ]);

        $formatTanggal = fn ($tgl) => Helper::terbilangTanggal(Carbon::parse(Helper::getTanggalSebelum($tgl, 0, 'HK')));

        $this->data([
            Row::make(
                Cell::make('GUP'),
                Cell::make(
                    ($gup && $tglNihil && $gup['akhir'] > $tglNihil)
                        ? $formatTanggal($tglNihil)
                        : ($gup ? $formatTanggal($gup['akhir']) : '-')
                ),
                Cell::make($minGup ? Helper::formatUang($minGup) : '-')->class('text-right')
            ),
            Row::make(
                Cell::make('TUP'),
                Cell::make(
                    ($tup && $tglNihil && $tup['akhir'] > $tglNihil)
                        ? $formatTanggal($tglNihil)
                        : ($tup && $tup['akhir'] && $tup['akhir'] !== '-' ? $formatTanggal($tup['akhir']) : '-')
                ),
                Cell::make($latestTup?->nilai ? Helper::formatUang($latestTup->nilai) : '-')->class('text-right')
            ),
        ]);
    }
}
