<?php

$n = $_GET["n"] ?? null;
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