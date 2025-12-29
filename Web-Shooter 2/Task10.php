<?php

// Интерфейс для оплаты
interface Payable {
    public function pay(float $amount): bool; // Метод оплаты
}

// Класс для оплаты наличными
class CashPayment implements Payable 
{
    public function pay($amount): bool
    {
        echo "Оплата наличкой: {$amount},\n";
        return true;
    }
}

// Класс для оплаты криптовалютой
class CryptoPayment implements Payable 
{
    public function pay($amount): bool
    {
        echo "Оплата криптой: {$amount}";
        return true;
    }
}

// Создаем объекты для разных типов оплаты
$cash = new CashPayment();
$crypyocash = new CryptoPayment(); 

// Выполняем оплату разными способами
$cash->pay(1012);
$crypyocash->pay(18);

?>

