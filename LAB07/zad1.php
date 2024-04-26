<?php
    $size = readline("Podaj dlugosc: ");
    $tablica = [];
    for($i = 0; $i < $size; $i++) {
        $tablica[] = readline();
    }
    $pozycja = readline("poz: ");
    if($pozycja < $size) {
        array_splice($tablica, $pozycja, 0, '$');
        print_r(array_values($tablica));
    }
    else echo "BLAD";
?>