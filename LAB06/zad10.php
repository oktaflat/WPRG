<?php
    $haslo = readline("Podaj haslo: ");
    if(strlen($haslo) >= 8 && ctype_alnum($haslo) && count(array_filter(str_split($haslo),'is_numeric')) >= 2)
        echo "haslo gut";
    else echo "haslo bad";
?>
