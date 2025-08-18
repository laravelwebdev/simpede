<?php

namespace App\Nova\Dashboards;

use App\Helpers\Helper;
use App\Nova\Metrics\Kegiatan;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravelwebdev\NovaQuotes\NovaQuotes;
use Richardkeep\NovaTimenow\NovaTimenow;

class Main extends Dashboard
{
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return 'Beranda';
    }

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        $values = array_map(function ($key) {
            return Helper::ROLE[$key];
        }, session('role'));

        $cards = [
            NovaQuotes::make()
                ->greetings(__('Welcome Back!'))
                ->user(auth()->user()->name ?? 'Guest')
                ->width('2/3')
                ->description('Role: '.implode(', ', $values))
                ->render(),
            NovaTimenow::make()
                ->width('1/3')
                ->timezones([
                    'Asia/Pontianak',
                    'Asia/Makassar',
                    'Asia/Jayapura',
                ])->defaultTimezone(config('app.timezone')),
            Kegiatan::make('Deadline')
                ->emptyText('Tidak ada deadline')
                ->width('1/3'),
            Kegiatan::make('Rapat')
                ->emptyText('Tidak ada rapat')
                ->width('1/3'),
            Kegiatan::make('Libur')
                ->emptyText('Tidak ada hari libur')
                ->width('1/3'),
        ];

        return $cards;
    }
}
