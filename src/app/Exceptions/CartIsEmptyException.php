<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CartIsEmptyException extends BaseException
{
    public function __construct()
    {
        parent::__construct('messages.empty_cart', Response::HTTP_BAD_REQUEST);
    }
}
