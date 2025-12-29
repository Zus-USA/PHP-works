<?php

// Конструктор с объявлением свойств прямо в параметрах
class Product {
    public function __construct(
        public string $name,
        public float $price
    ) {}
}

// Создаем экземпляр класса Product
$p = new Product("Молоко", 65.5);

// Выводим информацию о товаре
echo "Название: ". $p->name . ",\n";  
echo "Цена: ". $p->price ."";

?>