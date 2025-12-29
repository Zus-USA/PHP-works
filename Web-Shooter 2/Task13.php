<?php

// Подключение файлов вручную (без автозагрузчика)
require_once __DIR__ . '/src/Models/User.php';
require_once __DIR__ . '/src/Models/Product.php';
require_once __DIR__ . '/src/Models/Order.php';

// Импорт классов с использованием пространств имён
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

// Создание объекта пользователя
$user = new User("Алексей Смирнов", "alexey@example.com");
echo $user->getInfo();  // Вывод информации о пользователе

// Создание объектов продуктов
$product1 = new Product("Хлеб", 45.0);
$product2 = new Product("Молоко", 65.5);
echo $product1->getInfo();  // Вывод информации о продукте
echo $product2->getInfo();

// Создание заказа и добавление продуктов
$order = new Order(1001, $user);
$order->addProduct($product1);
$order->addProduct($product2);
echo $order->getInfo();  // Вывод информации о заказе

// Расчёт и вывод итоговой суммы
$total = $order->getTotal();
echo "Итоговая сумма заказа: {$total} руб.\n";