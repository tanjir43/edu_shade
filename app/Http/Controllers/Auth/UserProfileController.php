<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('profile.show', [
            'request'   => $request,
            'user'      => $request->user(),
        ]);
    }
}
