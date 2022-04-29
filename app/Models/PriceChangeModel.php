<?php

namespace App\Models;

class PriceChangeModel
{
    private string $name;
    private int $availableQuantity;
    private string $price;

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'availableQuantity' => $this->getAvailableQuantity(),
            'price' => $this->getPrice()
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): PriceChangeModel
    {
        $this->name = $name;

        return $this;
    }

    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    public function setAvailableQuantity(int $availableQuantity): PriceChangeModel
    {
        $this->availableQuantity = $availableQuantity;

        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): PriceChangeModel
    {
        $this->price = $price;

        return $this;
    }
}
