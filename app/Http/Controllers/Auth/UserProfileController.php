<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Contracts\PasswordUpdateResponse;
use Laravel\Fortify\Events\PasswordUpdatedViaController;
use Laravel\Jetstream\Actions\LogoutOtherBrowserSessions;

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

    public function logoutOtherSessions(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        if (Auth::check()) {
            DB::table('sessions')->where('user_id', Auth::id())->delete();
            Auth::logout();
        } else {
            return back()->withErrors(['error' => 'User is not authenticated']);
        }
        return back()->with('status', 'Other browser sessions logged out.');
    }
}
