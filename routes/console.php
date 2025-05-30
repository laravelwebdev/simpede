<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('reminder:send')->hourly()
    ->withoutOverlapping()
    ->runInBackground()
    ->sentryMonitor();
Schedule::command('action-events:clear')->daily()
    ->withoutOverlapping()
    ->runInBackground()
    ->sentryMonitor();
Schedule::command('holidays:sync')->daily()
    ->withoutOverlapping()
    ->runInBackground()
    ->sentryMonitor();
if (config('app.auto_update')) {
    Schedule::command('simpede:update')->dailyAt('0:30')
        ->withoutOverlapping()
        ->runInBackground()
        ->timezone(config('app.schedule_timezone'))
        ->sentryMonitor();
}
