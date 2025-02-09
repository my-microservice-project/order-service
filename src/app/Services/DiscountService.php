<?php

namespace App\Services;

use App\Exceptions\OrderCanNotCreatedException;
use App\Repositories\Contracts\DiscountRepositoryInterface;
use Exception;

class DiscountService
{
    public function __construct(
        protected DiscountRepositoryInterface $discountRepository,
    ) {}

    /**
     * @throws Exception
     */
    public function create(array $discountsData): bool
    {
        try {
            return $this->discountRepository->create($discountsData);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
