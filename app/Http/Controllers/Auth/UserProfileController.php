<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
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
        try {
            $updater->update($request->user(), $request->all());

            event(new PasswordUpdatedViaController($request->user()));

            return handleResponse('Password updated successfully.');

        } catch (ValidationException $e) {
            return handleResponse(null, null, $e->validator, $request->all());

        } catch (Exception $e) {
            return handleResponse(null, $e->getMessage());
        }
    }

    public function logoutOtherSessions(Request $request)
    {
        try {
            $request->validate([
                'password' => ['required', 'current_password'],
            ]);

            if (Auth::check()) {
                DB::table('sessions')->where('user_id', Auth::id())->delete();
                Auth::logout();

                return handleResponse('Other browser sessions logged out.');
            } else {
                return handleResponse(null, 'User is not authenticated.');
            }
        } catch (ValidationException $e) {
            return handleResponse(null, null, $e->validator, $request->all());
        } catch (\Exception $e) {
            return handleResponse(null, $e->getMessage());
        }
    }

}
