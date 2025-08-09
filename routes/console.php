<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('reminder:send')->hourly()
    ->sentryMonitor();
Schedule::command('action-events:clear')->daily()
    ->sentryMonitor();
Schedule::command('queue:clear')->daily()
    ->sentryMonitor();
Schedule::command('holidays:sync')->daily()
    ->sentryMonitor();
if (config('app.auto_update')) {
    Schedule::command('simpede:update')->dailyAt('01:00')
        ->withoutOverlapping()
        ->timezone(config('app.schedule_timezone'))
        ->sentryMonitor();
}
Schedule::command('db:optimize')->monthlyOn(1, '02:00')
    ->withoutOverlapping()
    ->timezone(config('app.schedule_timezone'))
    ->sentryMonitor();
Schedule::command('backup:clean')->dailyAt('16:30')
    ->withoutOverlapping()
    ->timezone(config('app.schedule_timezone'))
    ->sentryMonitor();
Schedule::command('backup:run')->dailyAt('17:00')
    ->withoutOverlapping()
    ->timezone(config('app.schedule_timezone'))
    ->sentryMonitor();
