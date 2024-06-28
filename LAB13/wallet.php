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
    <div id="wallet">
        <form action="storefront.php" method="POST">
            <label for="moneyAmount">Podaj ilość pieniędzy, jaką chcesz dodać:</label><br>
            <input type="text" name="moneyAmount" id="moneyAmount">
            <input type="submit" name="walletAdd" value="Dodaj">
        </form>
    </div>
</div>
</body>
</html>