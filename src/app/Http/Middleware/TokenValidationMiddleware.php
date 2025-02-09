<?php

namespace App\Http\Middleware;

use App\Exceptions\UserNotFoundException;
use BugraBozkurt\InterServiceCommunication\Exceptions\UnauthorizedException;
use BugraBozkurt\InterServiceCommunication\Helpers\AuthHelper;
use Closure;

class TokenValidationMiddleware
{
    /**
     * @throws UnauthorizedException|UserNotFoundException
     */
    public function handle($request, Closure $next)
    {
        if(!AuthHelper::customerId()){
            throw new UserNotFoundException();
        }

        return $next($request);
    }

}
