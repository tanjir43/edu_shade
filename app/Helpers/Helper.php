<?php

if (!function_exists('unauthorized_response')) {
    function unauthorized_response($status = 403, $message = null, $error_type = 'form', $lang = null)
    {
        if (!$message) {
            $message = __('lang.no_access', [], $lang);
        }

        return response()->json([
            'error_type' => $error_type,
            'message' => $message
        ], $status);
    }
}

if (!function_exists('user_can')) {
    function user_can($user, $role)
    {
        if (is_null($user) || !$user->can($role)) {
            return unauthorized_response();
        }
        return false;
    }
}
