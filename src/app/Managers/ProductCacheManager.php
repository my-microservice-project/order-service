<?php

namespace App\Managers;

use App\Enums\CacheEnum;
use Illuminate\Support\Facades\Cache;

class ProductCacheManager
{
    public function getStock(int $productId): ?int
    {
        return Cache::get(CacheEnum::STOCK->getValue() . $productId);
    }

    public function setStock(int $productId, int $quantity): void
    {
        Cache::put(CacheEnum::STOCK->getValue() . $productId, $quantity, now()->addMinutes(10));
    }

    public function getPrice(int $productId): ?float
    {
        $product = Cache::get(CacheEnum::PRODUCT->getValue() . $productId);

        return $product['price'] ?? 0;
    }

    public function setPrice(int $productId, float $price): void
    {
        Cache::put(CacheEnum::PRODUCT->getValue() . $productId, $price, now()->addMinutes(10));
    }
}
