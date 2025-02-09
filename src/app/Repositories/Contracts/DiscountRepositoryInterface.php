<?php

namespace App\Repositories\Contracts;

interface DiscountRepositoryInterface
{
    public function create(array $discountsData): bool;
}
