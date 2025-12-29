<?php

class StringUtils {
    // Статический метод для проверки строки на палиндром
    public static function isPalindrome(string $s): bool {
        // Приводим строку к нижнему регистру и удаляем пробелы
        $s = mb_strtolower(preg_replace('/\s+/', '', $s));
        // Сравниваем строку с её перевернутой версией
        return $s === strrev($s);
    }
}

echo'Level: '.(StringUtils::isPalindrome("Level")? "Yes" : "No")."\n";
echo'Мадам: '.(StringUtils::isPalindrome("Мадам")? "Yes" : "No")."\n";
echo'Тест: '.(StringUtils::isPalindrome("Тест")? "Yes" : "No")."\n";
echo'Racecar: '.(StringUtils::isPalindrome("rACeCar")? "Yes" : "No")."\n";
?>