<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Contracts\PasswordUpdateResponse;
use Laravel\Fortify\Events\PasswordUpdatedViaController;


class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('profile.show', [
            'request'   => $request,
            'user'      => $request->user(),
        ]);
    }

    public function updatePassword(Request $request, UpdatesUserPasswords $updater)
    {
        $updater->update($request->user(), $request->all());

        event(new PasswordUpdatedViaController($request->user()));

        return app(PasswordUpdateResponse::class);
    }
}
