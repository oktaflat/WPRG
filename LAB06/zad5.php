<?php
    $input = readline("Podaj string: ");
    $input = strtolower($input);

    $samogloski = ['a', 'i', 'u', 'e', 'o', 'y'];
    $wynik = 0;

    for($i = 0; $i < strlen($input); $i++) {
        if(!in_array($input[$i], $samogloski)) {
            $wynik++;
        }
    }
    echo "Ilosc spolglosek: $wynik";
?>