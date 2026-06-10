<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

trait AuthRedirectResponse
{
    protected function toIntendedOrHome(): RedirectResponse
    {
        $fallback = config('fortify.home');
        $redirectTo = request()->input('redirect_to');

        if (! is_string($redirectTo) || $redirectTo === '') {
            return redirect()->intended($fallback);
        }

        if (! Str::startsWith($redirectTo, '/')) {
            return redirect()->intended($fallback);
        }

        if (Str::startsWith($redirectTo, ['//', '/\\'])) {
            return redirect()->intended($fallback);
        }

        return redirect()->to($redirectTo);
    }
}
