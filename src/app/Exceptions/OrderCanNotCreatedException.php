<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class OrderCanNotCreatedException extends BaseException
{
    public function __construct()
    {
        parent::__construct('messages.order_not_created', Response::HTTP_BAD_REQUEST);
    }
}
