<?php

namespace App\Nova\Dashboards;

use App\Models\Pengelola;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Orion\NovaGreeter\GreeterCard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            GreeterCard::make()
                ->user(name: Auth::user()->nama, title: Auth::user()->email)
                ->message(text: __('Welcome Back!'))
                ->avatar(url: Storage::disk('avatars')->url(Auth::user()->avatar))
                ->verified(text: (Pengelola::cache()->get('all')->where('role', session('role'))->first() !== null) ? Pengelola::cache()->get('all')->where('role', session('role'))->first()->jabatan : 'Pegawai')
                ->width('1/3'),
            GreeterCard::make()
                ->user(name: 'PERHATIAN', title: 'Jangan Lupa untuk merefresh browser saat Anda mengganti peran.')
                ->message(text: '')
                ->avatar(url: Storage::disk('images')->url('warning.jpg'))
                ->width('1/3'),
            GreeterCard::make()
                ->user(name: 'Quotes of the day', title: Inspiring::quote())
                ->message(text: '')
                ->avatar(url: Storage::disk('images')->url('quotes.jpg'))
                ->width('1/3'),
        ];
    }
}
