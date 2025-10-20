<?php

class StringUtils {
    public static function isPalindrome(string $s): bool {
        $s = mb_strtolower(preg_replace('/\s+/', '', $s));
        return $s === strrev($s);
    }
}

echo'Level: '.(StringUtils::isPalindrome("Level")? "Yes" : "No")."\n";
echo'Мадам: '.(StringUtils::isPalindrome("Мадам")? "Yes" : "No")."\n";
echo'Тест: '.(StringUtils::isPalindrome("Тест")? "Yes" : "No")."\n";
echo'Racecar: '.(StringUtils::isPalindrome("rACeCar")? "Yes" : "No")."\n";
?>