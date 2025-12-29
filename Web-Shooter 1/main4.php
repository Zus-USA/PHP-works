<?php

// Функция преобразования числовой оценки в буквенную
function grade(int $score): string
{
    // Используем match для соответствия диапазонам оценок
    return match (true) {
        $score >= 90 => 'A',  // 90-100
        $score >= 75 => 'B',  // 75-89
        $score >= 60 => 'C',  // 60-74
        default => 'F',       // 0-59
    };
}

echo grade(95);  // A
echo grade(80);  // B  
echo grade(70);  // C
echo grade(45);  // F
echo grade(90);  // A (пограничный случай)
echo grade(75);  // B (пограничный случай)
echo grade(60),"\n";  // C (пограничный случай)

?>
