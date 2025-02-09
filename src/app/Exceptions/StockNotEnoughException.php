<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class StockNotEnoughException extends BaseException
{
    public function __construct()
    {
        parent::__construct('messages.stock_not_enough', Response::HTTP_BAD_REQUEST);
    }
}
