<?php

namespace App\Nova\Metrics;

use Illuminate\Support\Facades\DB;
use Laravelwebdev\Table\Table;
use Laravelwebdev\Table\Table\Cell;
use Laravelwebdev\Table\Table\Row;

class ResponRatePerJenisSurvei extends Table
{
    public function __construct()
    {
        $header = collect(['Jenis Survei', 'Triwulan I', 'Triwulan II', 'Triwulan III', 'Triwulan IV']);

        $this->title('Respon Rate Survei');
        $datas = DB::table('respon_rates')
            ->select(
                'jenis',
                DB::raw('IFNULL((realisasi_tw1 / target) * 100, 0) as persentase_tw1'),
                DB::raw('IFNULL((realisasi_tw2 / target) * 100, 0) as persentase_tw2'),
                DB::raw('IFNULL((realisasi_tw3 / target) * 100, 0) as persentase_tw3'),
                DB::raw('IFNULL((realisasi_tw4 / target) * 100, 0) as persentase_tw4')
            )
            ->where('tahun', session('year'))
            ->groupBy('jenis')
            ->get();
        $this->header($header->map(function ($value) {
            return ($value !== 'Jenis Survei') ?
                Cell::make($value)->class('text-right pr-6') :
                Cell::make($value);
        })->toArray());

        $this->data($datas->map(function ($data) {
            return Row::make(
                Cell::make($data->jenis),
                Cell::make($data->persentase_tw1)->class('text-right'),
                Cell::make($data->persentase_tw2)->class('text-right'),
                Cell::make($data->persentase_tw3)->class('text-right'),
                Cell::make($data->persentase_tw4)->class('text-right')
            );
        })->toArray());
    }
}
