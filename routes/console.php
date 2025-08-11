<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('reminder:send')->hourly()
    ->sentryMonitor();
Schedule::command('holidays:sync')->daily()
    ->sentryMonitor();
if (config('app.auto_update')) {
    Schedule::command('simpede:update')->dailyAt('01:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->timezone(config('app.schedule_timezone'))
        ->sentryMonitor();
}
Schedule::command('db:optimize')->monthlyOn(1, '02:00')
    ->withoutOverlapping()
    ->timezone(config('app.schedule_timezone'))
    ->sentryMonitor();
Schedule::command('simpede:backup')->dailyAt('17:30')
    ->withoutOverlapping()
    ->runInBackground()
    ->timezone(config('app.schedule_timezone'))
    ->sentryMonitor();
