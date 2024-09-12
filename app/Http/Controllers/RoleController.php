<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Nova;

class RoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function changeRole($role, Request $request)
    {
        if (Pengelola::cache()->get('all')->where('user_id', Auth::user()->id)->where('role', $role)->whereNull('inactive')->first() !== null) {
            session(['role' => $role]);
        }

        return redirect(Nova::path());
    }
}
