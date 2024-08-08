<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Nova;

Pengelola::cache()->get('all')->where('user_id','2')->where('role','pbj')->first();
