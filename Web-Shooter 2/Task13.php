<?php

require_once __DIR__ . '/../src/Models/User.php';
require_once __DIR__ . '/../src/Models/Product.php';
require_once __DIR__ . '/../src/Models/Order.php';

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

$user = new User("Алексей Смирнов", "alexey@example.com");
echo($user->getInfo());

$product1 = new Product("Хлеб", 45.0);
$product2 = new Product("Молоко", 65.5);
echo($product1->getInfo());
echo($product2->getInfo());

$order = new Order(1001, $user);
$order->addProduct($product1);
$order->addProduct($product2);
echo($order->getInfo());
$total = $order->getTotal();
echo("Итоговая сумма заказа: $total руб.");

?>
