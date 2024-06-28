<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Sklep internetowy - Koszyk</title>
    <link href="lab13.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div id="all">
    <div id="cart">
        <table>
            <thead>
            <tr>
                <th></th>
                <th>Nazwa</th>
                <th>Cena</th>
                <th>Ilość</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <!--                user cart db-->
            </tbody>
        </table>
        <form action="#" method="GET">
            <input type="submit" name="clearCart" value="Wyczyść koszyk">
            <?php
                // if user has enough money
                    echo '<input type="submit" name="purchase" value="Kup produkty">';
                // else
                    echo '<input type="submit" name="purchase" value="Kup produkty" disabled>';
            ?>
        </form>
    </div>
</div>
</body>
</html>