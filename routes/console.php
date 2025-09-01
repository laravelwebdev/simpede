<?php

use Illuminate\Support\Facades\Schedule;

if (config('app.auto_update')) {
    Schedule::command('simpede:update')->dailyAt('01:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->timezone(config('app.schedule_timezone'));
}
Schedule::command('simpede:backup create')->dailyAt('18:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->timezone(config('app.schedule_timezone'));
Schedule::command('reminder:send')->hourly();
Schedule::command('holidays:sync')->daily();
Schedule::command('simpede:clear-error-log')->weeklyOn(0, '03:00')
    ->timezone(config('app.schedule_timezone'));
