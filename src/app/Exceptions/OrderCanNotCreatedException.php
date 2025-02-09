<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class OrderCanNotCreatedException extends Exception
{
    public function __construct()
    {
        parent::__construct('messages.order_not_created', Response::HTTP_BAD_REQUEST);
    }
}
