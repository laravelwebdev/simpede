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
    $userId = Auth::user()->id;

    if (Pengelola::cache()->get('all')->where('user_id', $userId)
        ->whereNull('inactive')->contains('role', $role)) {
        session(['role' => $role]);
    }

    return redirect(Nova::path());
}

}
