<?php

namespace App\Models;

class Order
{
    private int $orderId;
    private User $user;
    private array $products = [];

    public function __construct(int $orderId, User $user)
    {
        $this->orderId = $orderId;
        $this->user = $user;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getInfo(): string
    {
        $info = "Заказ №{$this->orderId} для {$this->user->getName()}\n";
        $info .= "Список товаров:\n";
        foreach ($this->products as $product) {
            $info .= " - {$product->getName()} ({$product->getPrice()} руб.)\n";
        }
        return $info;
    }

    public function getTotal(): float
    {
        $total = 0.0;
        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }
        return $total;
    }
}