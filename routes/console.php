<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('reminder:send')->hourly()
    ->withoutOverlapping()
    ->runInBackground();
Schedule::command('action-events:clear')->daily()
    ->withoutOverlapping()
    ->runInBackground();
Schedule::command('holidays:sync')->daily()
    ->withoutOverlapping()
    ->runInBackground();
Schedule::command('pulse:check')->hourly()
    ->withoutOverlapping()
    ->runInBackground();
