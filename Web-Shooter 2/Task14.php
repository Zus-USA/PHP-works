<?php

// Класс Product
class Product {
    public $name;    // Название товара
    public $price;   // Цена товара
    
    public function __construct($name, $price) {
        $this->name = $name;     // Инициализация названия
        $this->price = $price;   // Инициализация цены
    }
}

// Класс Cart
class Cart {
    private $items = array();  // Массив для хранения товаров
    
    // Метод добавления товара в корзину
    public function add($p) {
        $this->items[] = $p;  // Добавление товара в массив
        echo("Товар '$p->name' добавлен в корзину.");
    }
    
    // Метод расчёта общей суммы корзины
    public function getTotal() {
        $total = 0;  // Начальная сумма
        
        // Перебор всех товаров в корзине
        foreach ($this->items as $item) {
            $total += $item->price;  // Суммирование цен
        }
        return $total;
    }
    
    // Метод отображения содержимого корзины
    public function showItems() {
        echo("Содержимое корзины:");
        $index = 1;  // Счётчик для нумерации
        
        // Перебор и вывод всех товаров
        foreach ($this->items as $item) {
            echo("$index. $item->name - $item->price руб.");
            $index++;
        }
    }
}

// Создание объектов товаров
$product1 = new Product("Молоко", 65.5);
$product2 = new Product("Хлеб", 45.0);
$product3 = new Product("Сыр", 350.0);
$product4 = new Product("Масло", 180.5);

// Создание объекта корзины
$cart = new Cart();

// Добавление товаров в корзину
$cart->add($product1);
$cart->add($product2);
$cart->add($product3);
$cart->add($product4);

// Отображение содержимого корзины
$cart->showItems();

// Расчёт и вывод итоговой суммы
$total = $cart->getTotal();
echo("Итоговая сумма: $total руб.");

?>