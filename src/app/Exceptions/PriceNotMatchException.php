<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class PriceNotMatchException extends BaseException
{
    public function __construct()
    {
        parent::__construct('messages.price_not_match', Response::HTTP_BAD_REQUEST);
    }
}
