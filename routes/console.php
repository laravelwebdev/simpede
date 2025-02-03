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
