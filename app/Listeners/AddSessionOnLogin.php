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

        $roles = Pengelola::cache()->get('all')
            ->where('user_id', $user->id)
            ->whereNull('inactive')
            ->pluck('role')
            ->toArray();
        $year = $event->remember ? request()->cookie('simpede_year') : request()->input('year');
        Session::put('role', $roles);
        Session::put('year', $year ?? date('Y'));
    }
}
