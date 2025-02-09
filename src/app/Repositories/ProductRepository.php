<?php

namespace App\Repositories;

use App\Data\Product\ProductStockAvailableDTO;
use App\Enums\CacheEnum;
use App\Exceptions\ServiceUnavailable;
use App\Exceptions\StockNotEnoughException;
use App\Exceptions\ProductNotFoundException;
use App\Repositories\Contracts\ProductRepositoryInterface;
use BugraBozkurt\InterServiceCommunication\Facades\Stock;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @throws StockNotEnoughException
     * @throws ServiceUnavailable
     * @throws ProductNotFoundException
     */
    public function checkStock(int $productId, int $quantity): void
    {
        $stockData = $this->getStockData($productId);

        if ($stockData->quantity < $quantity) {
            throw new StockNotEnoughException();
        }
    }

    /**
     * @param int $productId
     * @return ProductStockAvailableDTO
     * @throws ServiceUnavailable
     * @throws ProductNotFoundException
     */
    private function getStockData(int $productId): ProductStockAvailableDTO
    {
        $cachedStock = Cache::get($this->getCacheKey($productId));

        if ($cachedStock !== null) {
            return new ProductStockAvailableDTO(
                productId: $productId,
                quantity: $cachedStock
            );
        }

        return $this->fetchStockFromService($productId);
    }

    /**
     * @param int $productId
     * @return ProductStockAvailableDTO
     * @throws ServiceUnavailable
     * @throws ProductNotFoundException
     */
    private function fetchStockFromService(int $productId): ProductStockAvailableDTO
    {
        $response = Stock::get("/api/v1/stocks/{$productId}");

        if (!$response->successful()) {
            if ($response->status() === 404) {
                throw new ProductNotFoundException();
            }

            throw new ServiceUnavailable();
        }

        $stockData = $response->json('data');

        if (empty($stockData['quantity'])) {
            throw new ProductNotFoundException();
        }

        return new ProductStockAvailableDTO(
            productId: $productId,
            quantity: $stockData['quantity']
        );
    }

    /**
     * Cache anahtarını oluştur
     */
    private function getCacheKey(int $productId): string
    {
        return CacheEnum::STOCK->getValue() . $productId;
    }
}
