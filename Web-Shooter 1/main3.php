<?php

function divide(float $a, float $b): ?float 
{
    return $b === 0.0 ? null : $a / $b;
}

echo divide(10,4),"\n";

$result = divide(10,-0);
if ($result === null)
{
    echo "Ошибка деления на ноль","\n";
}


?>