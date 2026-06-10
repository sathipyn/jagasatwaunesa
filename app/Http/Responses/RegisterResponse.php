<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    use AuthRedirectResponse;

    public function toResponse($request)
    {
        return $this->toIntendedOrHome();
    }
}
