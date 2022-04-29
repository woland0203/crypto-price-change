<?php

namespace App\Repositories;

use App\Models\PriceChangeModel;
use App\Services\Clients\BinanceHttpClientService;
use App\Services\Factories\BinancePriceChangeFactory;

class PriceChangeApiRepository
{
    private const ALL_DATA_URL = 'ticker/24hr';
    private const DELETE_URL = 'delete/';
    private const UPDATE_URL = 'update/';
    private const CREATE_URL = 'create/';

    private BinanceHttpClientService $binanceHttpClientService;
    private BinancePriceChangeFactory $binancePriceChangeFactory;

    public function __construct(BinanceHttpClientService $binanceHttpClientService, BinancePriceChangeFactory $binancePriceChangeFactory)
    {
        $this->binanceHttpClientService = $binanceHttpClientService;
        $this->binancePriceChangeFactory = $binancePriceChangeFactory;
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return PriceChangeModel[]|array
     */
    public function getAll(?int $limit, ?int $offset = 0): array
    {
        $allData = array_slice($this->loadData(), $offset, $limit);

        return array_map(function (array $row) {
            return $this->binancePriceChangeFactory->createFromBinanceResponse($row);
        }, $allData);
    }

    public function getByName(string $name): ?PriceChangeModel
    {
        $allData = $this->loadData();
        foreach ($allData as $row) {
            if ($row['symbol'] === $name) {
                return $this->binancePriceChangeFactory->createFromBinanceResponse($row);
            }
        }

        return null;
    }

    public function create(array $data): PriceChangeModel
    {
        $this->binanceHttpClientService->post(self::CREATE_URL, $data);

        return $this->binancePriceChangeFactory->createFromApiRequest($data);
    }

    public function updateByName(string $name, array $data): ?PriceChangeModel
    {
        $item = $this->getByName($name);
        if (!$item) {
            return null;
        }

        $updatedItem = array_merge($item->toArray(), $data);
        $this->binanceHttpClientService->post(self::UPDATE_URL . $name,  $updatedItem);

        return $this->binancePriceChangeFactory->createFromApiRequest($updatedItem);
    }

    public function deleteByName(string $name): void
    {
        $this->binanceHttpClientService->delete(self::DELETE_URL . $name);
    }

    private function loadData(): array
    {
        return $this->binanceHttpClientService->get(self::ALL_DATA_URL)->json();
    }
}
