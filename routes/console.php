<?php

use Illuminate\Support\Facades\Schedule;

if (config('app.auto_update')) {
    Schedule::command('simpede:update')->dailyAt('01:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->timezone(config('app.schedule_timezone'))
        ->sentryMonitor();
}
Schedule::command('db:optimize')->monthlyOn(1, '02:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->timezone(config('app.schedule_timezone'))
    ->sentryMonitor();
Schedule::command('simpede:backup')->dailyAt('18:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->timezone(config('app.schedule_timezone'))
    ->sentryMonitor();
Schedule::command('reminder:send')->hourly()
    ->sentryMonitor();
Schedule::command('holidays:sync')->daily()
    ->sentryMonitor();
