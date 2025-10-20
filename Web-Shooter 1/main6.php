<?php

$numbers = [1, 2, 3, 4, 5];

print_r (array_map (fn($n) => $n ** 2, $numbers));

?>