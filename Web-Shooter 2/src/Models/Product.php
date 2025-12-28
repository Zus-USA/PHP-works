<?php

namespace App\Models;

class Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getInfo(): string
    {
        return "Товар: {$this->name}, Цена: {$this->price} руб.\n";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}