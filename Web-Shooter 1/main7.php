<?php

// Получаем значение 'n' из GET-параметров или используем null, если параметр отсутствует
$n = $_GET["n"] ?? null;

// Приводим значение к целому типу (если null, станет 0)
$n = (int) $n;

if ($n % 15 === 0) 
    {
        echo "FizzBuzz";
    }
    elseif ($n % 3 === 0)
        {
            echo "Fizz";
        }
        elseif ($n %5=== 0)
            {
                echo "Buzz";
            }
            else 
                {
                    echo "$n";
                }
?>