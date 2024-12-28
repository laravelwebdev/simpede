<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('reminder:send')
    ->timezone(config('app.timezone'))
    ->twiceDaily(9, 15);
