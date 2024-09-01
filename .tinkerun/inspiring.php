<?php

use App\Helpers\Inspiring;
use Illuminate\Support\Carbon;

Carbon::createFromFormat('Y-m-d','2024-01-01');
$b='[""]';
collect(json_decode($b))->count()











