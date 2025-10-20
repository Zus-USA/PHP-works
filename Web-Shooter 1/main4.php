<?php
function grade(int $score): string
{
    return match (true) {
        $score >= 90 => 'A',
        $score >= 75 => 'B',
        $score >= 60 => 'C',
        default => 'F',
    };
}
echo grade(95);  
echo grade(80);   
echo grade(70);   
echo grade(45);   
echo grade(90);  
echo grade(75);   
echo grade(60),"\n";  

?>