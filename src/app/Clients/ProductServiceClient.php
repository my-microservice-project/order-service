<?php

namespace App\Clients;

use App\Data\Product\{ProductPriceAvailableDTO,ProductStockAvailableDTO};
use BugraBozkurt\InterServiceCommunication\Facades\{Product,Stock};
use App\Exceptions\{ProductNotFoundException,ServiceUnavailable};

class ProductServiceClient
{
    /**
     * @throws ServiceUnavailable
     * @throws ProductNotFoundException
     */
    public function fetchStock(int $productId): ProductStockAvailableDTO
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
     * @throws ServiceUnavailable
     * @throws ProductNotFoundException
     */
    public function fetchPrice(int $productId): ProductPriceAvailableDTO
    {
        $response = Product::get("/api/v1/products/{$productId}");

        if (!$response->successful()) {
            if ($response->status() === 404) {
                throw new ProductNotFoundException();
            }
            throw new ServiceUnavailable();
        }

        $priceData = $response->json('data');

        if (empty($priceData['price'])) {
            throw new ProductNotFoundException();
        }

        return new ProductPriceAvailableDTO(
            productId: $productId,
            price: $priceData['price']
        );
    }
}
