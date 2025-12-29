<?php

// Пространство имён App\Models
namespace App\Models;

// Класс Order (Заказ)
class Order
{
    // Приватные свойства заказа
    private int $orderId;      // ID заказа (тип: целое число)
    private User $user;        // Объект пользователя (тип: User)
    private array $products = []; // Массив товаров в заказе

    // Конструктор класса Order
    // Принимает ID заказа и объект пользователя
    public function __construct(int $orderId, User $user)
    {
        $this->orderId = $orderId; // Установка ID заказа
        $this->user = $user;       // Связывание заказа с пользователем
    }

    // Метод добавления товара в заказ
    // Принимает объект Product в качестве параметра
    // Тип возвращаемого значения: void (ничего не возвращает)
    public function addProduct(Product $product): void
    {
        // Добавление товара в конец массива продуктов
        $this->products[] = $product;
    }

    // Метод для получения информации о заказе
    // Формирует подробное описание заказа
    public function getInfo(): string
    {
        // Начало формирования строки с информацией
        $info = "Заказ №{$this->orderId} для {$this->user->getName()}\n";
        $info .= "Список товаров:\n";
        
        // Перебор всех товаров в заказе
        foreach ($this->products as $product) {
            // Добавление информации о каждом товаре
            $info .= " - {$product->getName()} ({$product->getPrice()} руб.)\n";
        }
        
        return $info; // Возврат сформированной строки
    }

    // Метод для расчёта общей суммы заказа
    public function getTotal(): float
    {
        $total = 0.0; // Инициализация переменной для суммы
        
        // Перебор всех товаров и суммирование их цен
        foreach ($this->products as $product) {
            $total += $product->getPrice(); // Добавление цены товара к общей сумме
        }
        
        return $total; // Возврат общей суммы
    }
}