<?php

class Product {
    public function __construct(
        public string $name,
        public float $price
    ) {}
}

$p = new Product("Молоко", 65.5);

echo "Название: ". $p->name . ",\n";  
echo "Цена: ". $p->price ."";

?>