<?php

namespace App\Repositories;

use App\Clients\ProductServiceClient;
use App\Data\Product\ProductPriceAvailableDTO;
use App\Data\Product\ProductStockAvailableDTO;
use App\Exceptions\PriceNotMatchException;
use App\Exceptions\StockNotEnoughException;
use App\Managers\ProductCacheManager;
use App\Repositories\Contracts\ProductRepositoryInterface;

readonly class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private ProductCacheManager  $cacheManager,
        private ProductServiceClient $serviceClient
    ) {}

    /**
     * @param int $productId
     * @param int $quantity
     * @throws StockNotEnoughException
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
     * @param float $unitPrice
     * @throws PriceNotMatchException
     */
    public function checkPrice(int $productId, float $unitPrice): void
    {
        $priceData = $this->getPriceData($productId);

        if($priceData->price != $unitPrice) {
            throw new PriceNotMatchException();
        }
    }

    private function getStockData(int $productId): ProductStockAvailableDTO
    {
        $cachedStock = $this->cacheManager->getStock($productId);

        if ($cachedStock !== null) {
            return new ProductStockAvailableDTO(productId: $productId, quantity: $cachedStock);
        }

        $stockData = $this->serviceClient->fetchStock($productId);
        $this->cacheManager->setStock($productId, $stockData->quantity);

        return $stockData;
    }

    private function getPriceData(int $productId): ProductPriceAvailableDTO
    {
        $cachedPrice = $this->cacheManager->getPrice($productId);

        if ($cachedPrice !== null) {
            return new ProductPriceAvailableDTO(productId: $productId, price: $cachedPrice);
        }

        $priceData = $this->serviceClient->fetchPrice($productId);
        $this->cacheManager->setPrice($productId, $priceData->price);

        return $priceData;
    }
}
