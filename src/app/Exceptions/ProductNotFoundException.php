<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ProductNotFoundException extends BaseException
{
    public function __construct()
    {
        parent::__construct('messages.product_not_found', Response::HTTP_BAD_REQUEST);
    }
}
