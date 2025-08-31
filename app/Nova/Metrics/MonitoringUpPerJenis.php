<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\Dipa;
use Laravel\Nova\Nova;
use Laravelwebdev\Table\Table;
use Laravelwebdev\Table\Table\Cell;
use Laravelwebdev\Table\Table\Row;

class MonitoringUpPerJenis extends Table
{
    public function __construct()
    {
        $tglNihil = optional(
            Dipa::cache()->get('all')
                ->where('tahun', session('year'))
                ->first()
        )->tanggal_nihil;
        $gup = null;
        $minGup = null;
        $tup = null;
        $latestTup = null;
        $latestUp = Helper::getLatestUp(session('year'));
        if ($latestUp) {
            $nilaiGup = optional($latestUp)->nilai ?? 0;
            $latestGup = Helper::getLatestGup(session('year'));
            $gup = Helper::hitungPeriodeGup(optional($latestGup)->tanggal);
            $latestTup = Helper::getLatestTup(session('year'));
            $tup = Helper::hitungPeriodeGup(optional($latestTup)->tanggal);
            $hariGup = floor(now()->diffInDays($gup['awal'], true));
            $minGup = ceil(($hariGup / $gup['hari']) * $nilaiGup);
            if ($minGup < 0.5 * $nilaiGup) {
                $minGup = 0.5 * $nilaiGup;
            } elseif ($minGup > $nilaiGup) {
                $minGup = $nilaiGup;
            }
        }

        $this->viewAll([
            'label' => Helper::terbilangTanggal(now()), // Label for the link
            'link' => Nova::path().'/resources/uang-persediaans/lens/monitoring-up', // URL to navigate when the link is clicked
            'position' => 'top', // (Possible values `top` - `bottom`)
            'style' => 'button', // (Possible values `link` - `button`)
        ]);

        $this->title('Monitoring UP/TUP');

        $this->header([
            Cell::make('Jenis'),
            Cell::make('Deadline GUP/GTUP'),
            Cell::make('Jumlah Minimal jika SP2D hari ini')->class('text-right'),
        ]);

        $this->data([
            Row::make(
                Cell::make('GUP'),
                Cell::make(
                    ($gup && $tglNihil && $gup['akhir'] > $tglNihil)
                        ? Helper::terbilangTanggal($tglNihil)
                        : ($gup ? Helper::terbilangTanggal($gup['akhir']) : '-')
                ),
                Cell::make($minGup ? Helper::formatUang($minGup) : '-')->class('text-right')
            ),
            Row::make(
                Cell::make('TUP'),
                Cell::make(
                    ($tup && $tglNihil && $tup['akhir'] > $tglNihil)
                        ? Helper::terbilangTanggal($tglNihil)
                        : ($tup && $tup['akhir'] !== '-' ? Helper::terbilangTanggal($tup['akhir']) : ($tup['akhir'] ?? '-'))
                ),
                Cell::make($latestTup ? Helper::formatUang(optional($latestTup)->nilai) : '-')->class('text-right')
            ),
        ]
        );
    }
}
