<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use App\Models\Dipa;
use App\Models\TargetKkp;
use App\Models\UangPersediaan;
use Laravel\Nova\Nova;
use Laravelwebdev\Table\Table;
use Laravelwebdev\Table\Table\Cell;
use Laravelwebdev\Table\Table\Row;

class MonitoringKkp extends Table
{
    public function __construct()
    {
        $bulan = session('year') < date('Y') ? 12 : (int) date('m');
        $dipa = Dipa::cache()->get('all')
            ->where('tahun', session('year'))
            ->first();
        $target = optional(TargetKkp::cache()->get('all')
            ->where('dipa_id', optional($dipa)->id)
            ->where('bulan', $bulan)
            ->first())->nilai ?? 0;
        $realisasi = UangPersediaan::where('dipa_id', optional($dipa)->id)
            ->where('jenis', 'GUP KKP')
            ->whereNowOrPast('tanggal')
            ->sum('nilai');
        $selisih = $realisasi - $target;
        $this->viewAll([
            'label' => 'Triwulan '.ceil($bulan / 3), // Label for the link
            'link' => Nova::path().'/resources/uang-persediaans/lens/monitoring-up', // URL to navigate when the link is clicked
            'position' => 'top', // (Possible values `top` - `bottom`)
            'style' => 'button', // (Possible values `link` - `button`)
        ]);

        $this->title('Monitoring Penggunaan KKP');

        $this->header([
            Cell::make('Target')->class('text-right'),
            Cell::make('Realisasi')->class('text-right'),
            Cell::make('Selisih')->class('text-right'),
        ]);

        $this->data([
            Row::make(
                Cell::make($target ? Helper::formatUang($target) : '-')->class('text-right'),
                Cell::make($realisasi ? Helper::formatUang($realisasi) : '-')->class('text-right'),
                Cell::make($selisih ? Helper::formatUang($selisih) : '-')->class('text-right')
            ),
        ]
        );
    }
}
