<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function updateLanguage(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'language_id' => 'required|exists:languages,id',
        ]);

        $language = app('view_data')->languages()->where('id', $request->language_id)->first();

        if (!$user || !$language) {
            return response()->json(['success' => false, 'message' => 'Invalid language or user.'], 403);
        }

        $user->language_id  = $request->language_id;
        $user->rtl_ltr      = $language->rtl == 1 ? 1 : 0;

        $user->save();

        return response()->json(['success' => true, 'message' => 'Language updated successfully.']);
    }
}
