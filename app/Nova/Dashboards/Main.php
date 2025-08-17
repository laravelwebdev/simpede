<?php

namespace App\Nova\Dashboards;

use App\Helpers\Helper;
use App\Nova\Metrics\Deadline;
use App\Nova\Metrics\Rapat;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravelwebdev\NovaQuotes\NovaQuotes;

class Main extends Dashboard
{
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return 'Tahun '.session('year');
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
