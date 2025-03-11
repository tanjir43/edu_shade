<?php

if (!function_exists('handleResponse')) {
    function handleResponse($success = null, $error = null, $errors = [], $input = [])
    {
        $redirect = redirect()->back()->with('alert_type', getAlertType());

        if ($success) {
            $redirect->with('success', $success);
        }

        if ($error) {
            $redirect->with('error', $error);
        }

        if (!empty($errors)) {
            $redirect->withErrors($errors);
        }

        if (!empty($input)) {
            $redirect->withInput($input);
        }

        return $redirect;
    }
}
