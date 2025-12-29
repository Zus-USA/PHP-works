<?php

// Пространство имён App\Models
namespace App\Models;

// Класс Product (Товар)
class Product
{
    // Приватные свойства товара
    private string $name;   // Название товара
    private float $price;   // Цена товара (тип: число с плавающей точкой)

    // Конструктор класса Product
    public function __construct(string $name, float $price)
    {
        $this->name = $name;   // Установка названия товара
        $this->price = $price; // Установка цены товара
    }

    // Метод для получения полной информации о товаре
    public function getInfo(): string
    {
        return "Товар: {$this->name}, Цена: {$this->price} руб.\n";
    }

    // Геттер для получения названия товара
    public function getName(): string
    {
        return $this->name;
    }

    // Геттер для получения цены товара
    public function getPrice(): float
    {
        return $this->price;
    }
}