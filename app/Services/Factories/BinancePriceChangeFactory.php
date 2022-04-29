<?php

namespace App\Services\Factories;

use App\Models\PriceChangeModel;

class BinancePriceChangeFactory
{
    public function createFromBinanceResponse(array $row): PriceChangeModel
    {
        return (new PriceChangeModel())
            ->setName($row['symbol'] ?? '')
            ->setAvailableQuantity($row['volume'] ?? 0)
            ->setPrice($row['bidPrice'] ?? '');
    }

    public function createFromApiRequest(array $row): PriceChangeModel
    {
        return (new PriceChangeModel())
            ->setName($row['name'] ?? '')
            ->setAvailableQuantity($row['availableQuantity'] ?? 0)
            ->setPrice($row['price'] ?? '');
    }
}
