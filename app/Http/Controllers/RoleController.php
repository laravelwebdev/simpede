<?php

namespace App\Http\Controllers;

use App\Models\Pengelola;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Nova;

class RoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($role)
    {
        if ((Pengelola::cache()->get('all')->where('user_id', Auth::user()->id)->where('role', $role)->first() !== null) || ($role === Auth::user()->role)) {
            session(['role' => $role]);
        }

        return redirect(Nova::path());
    }
}
