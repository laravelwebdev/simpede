<?php

namespace App\Nova\Dashboards;

use App\Helpers\Helper;
use App\Nova\Metrics\Rapat;
use App\Nova\Metrics\Deadline;
use Laravelwebdev\Welcome\Welcome;
use Laravelwebdev\NovaQuotes\NovaQuotes;
use Laravel\Nova\Dashboards\Main as Dashboard;

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
                ->width('full')
                ->description('Role: '.implode(', ', $values))
                ->render(),
            Deadline::make()
                ->emptyText('Tidak ada deadline')
                ->width('1/2'),
            Rapat::make()
                ->emptyText('Tidak ada rapat')
                ->width('1/2'),           
        ];

        return $cards;
    }
}
