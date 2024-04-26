<?php
    $rozmiar = readline("Podaj ilosc liczb (w postaci osemkowej): ");
    $tablica = [];
    for($i = 0; $i < $rozmiar; $i++) {
        $tablica[] = dechex(octdec(readline()));
    }
    print_r(array_values($tablica));
?>