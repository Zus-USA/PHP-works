<?php

class Product {
    public $name;
    public $price;
    
    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
}

class Cart {
    private $items = array();
    
    public function add($p) {
        $this->items[] = $p;
        echo("Товар '$p->name' добавлен в корзину.");
    }
    
    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->price;
        }
        return $total;
    }
    
    public function showItems() {
        echo("Содержимое корзины:");
        $index = 1;
        foreach ($this->items as $item) {
            echo("$index. $item->name - $item->price руб.");
            $index++;
        }
    }
}

$product1 = new Product("Молоко", 65.5);
$product2 = new Product("Хлеб", 45.0);
$product3 = new Product("Сыр", 350.0);
$product4 = new Product("Масло", 180.5);

$cart = new Cart();

$cart->add($product1);
$cart->add($product2);
$cart->add($product3);
$cart->add($product4);

$cart->showItems();

$total = $cart->getTotal();
echo("Итоговая сумма: $total руб.");

?>
