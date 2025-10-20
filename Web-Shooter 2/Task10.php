<?php

interface Payable {
    public function pay(float $amount): bool;
}

class CashPayment implements Payable 
{
    public function pay($amount): bool
    {
        echo "Оплата наличкой: {$amount},\n";
        return true;
    }
}
class CryptoPayment implements Payable 
{
    public function pay($amount): bool
    {
        echo "Оплата криптой: {$amount}";
        return true;
    }
}

$cash = new CashPayment();
$crypyocash = new CryptoPayment();

$cash->pay(1012);
$crypyocash->pay(18);

?>