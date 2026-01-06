<?php

namespace App\Nova\Metrics;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Nova;
use Laravelwebdev\Table\Table;
use Laravelwebdev\Table\Table\Cell;
use Laravelwebdev\Table\Table\Row;

class JumlahPostingPerPegawai extends Table
{
    public function __construct()
    {
        $header = collect(['Nama', 'Jumlah']);
        $this->viewAll([
            'label' => 'Refresh',
            'link' => Nova::path().'/resources/posting-kontens', // URL to navigate when the link is clicked
            'position' => 'top', // (Possible values `top` - `bottom`)
            'style' => 'button', // (Possible values `link` - `button`)
        ]);

        $this->title('Monitoring Jumlah Posting Per Pegawai');

        $datas = DB::table('posting_kontens')
            ->selectRaw('name, COUNT(CASE WHEN status NOT IN ("Dibatalkan", "Terlewat") THEN 1 END) as realisasi')
            ->join('users', function ($join) {
                $join->on('posting_kontens.user_id', '=', 'users.id');
            })
            ->whereYear('tanggal', '=', session('year'))
            ->groupBy('name')
            ->orderBy('realisasi', 'desc')
            ->get();

        $this->header($header->map(function ($value) {
            return ($value !== 'Jumlah') ?
                Cell::make($value) :
                Cell::make($value)->class('text-right pr-6');
        })->toArray());

        $this->data($datas->map(function ($data) {
            return Row::make(
                Cell::make($data->name),
                Cell::make(Helper::formatUang($data->realisasi))->class('text-right'),
            );
        })->toArray());
    }
}
