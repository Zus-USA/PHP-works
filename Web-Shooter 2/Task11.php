<?php

class MathUtils {
    public static function square(float $x): float 
    {
        return $x * $x;
    }
}

$number = 5;
$result = (new MathUtils())->square($number);
echo "Результат возведения числа {$number} в степень 2: {$result}";

?>