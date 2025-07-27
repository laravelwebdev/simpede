<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('reminder:send')->hourly()
    ->withoutOverlapping()
    ->sentryMonitor();
Schedule::command('action-events:clear')->daily()
    ->withoutOverlapping();
Schedule::command('queue:clear')->daily()
    ->withoutOverlapping();
Schedule::command('holidays:sync')->daily()
    ->withoutOverlapping()
    ->sentryMonitor();
if (config('app.auto_update')) {
    Schedule::command('simpede:update')->dailyAt('1:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->timezone(config('app.schedule_timezone'))
        ->sentryMonitor();
}
