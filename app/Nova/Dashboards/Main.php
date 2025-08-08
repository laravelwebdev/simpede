<?php

namespace App\Nova\Dashboards;

use App\Helpers\Helper;
use App\Helpers\Inspiring;
use App\Nova\Metrics\Deadline;
use App\Nova\Metrics\Rapat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravelwebdev\Greeter\Greeter;

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

        $quotes = Inspiring::show();
        $cards = [
            Greeter::make()
                ->user(name: Auth::user()->name, title: Auth::user()->email)
                ->message(text: __('Welcome Back!'))
                ->avatar(url: Storage::disk('avatars')->url(Auth::user()->avatar))
                ->verified(text: implode(', ', $values))
                ->width('1/2'),
            Greeter::make()
                ->user(name: 'Kata-kata Hari Ini', title: $quotes['quote'])
                ->message(text: '')
                ->verified(text: $quotes['author'])
                ->avatar(url: Storage::disk('images')->url('quotes.svg'))
                ->width('1/2'),
            Deadline::make()
                ->emptyText('Tidak ada deadline')
                ->width('full'),
            Rapat::make()
                ->emptyText('Tidak ada rapat')
                ->width('full'),

        ];

        return $cards;
    }
}
