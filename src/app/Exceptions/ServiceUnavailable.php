<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ServiceUnavailable extends BaseException
{
    public function __construct()
    {
        parent::__construct('messages.service_unavailable', Response::HTTP_BAD_REQUEST);
    }
}
