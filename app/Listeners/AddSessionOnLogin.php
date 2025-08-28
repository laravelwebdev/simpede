<?php

namespace App\Listeners;

use App\Models\Pengelola;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;

class AddSessionOnLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        // Cek roles user aktif
        $roles = Pengelola::cache()->get('all')
            ->where('user_id', $user->id)
            ->whereNull('inactive')
            ->pluck('role')
            ->toArray();

        // Jika login via remember-me tapi cookie simpede_year hilang → paksa logout
        if ($event->remember && ! request()->hasCookie('simpede_year')) {
            auth()->logout();

            return; // Laravel akan arahkan user ke login page default
        }

        // Set year di session
        $year = $event->remember
            ? request()->cookie('simpede_year')
            : request()->input('year', date('Y'));

        session(['role' => $roles, 'year' => $year]);
    }
}
