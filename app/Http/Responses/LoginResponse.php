<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    use AuthRedirectResponse;

    public function toResponse($request)
    {
        return $this->toIntendedOrHome();
    }
}
