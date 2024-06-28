<?php
    session_start();
    if(isset($_POST["walletAdd"]))
        moneyAdd($_POST["moneyAmount"]);
    if(isset($_POST["purchase"]))
        purchase();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Sklep internetowy</title>
    <link href="lab13.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div id="all">
    <div id="products">
        <?php echo "Witaj, " . $_SESSION["username"] . "!"; ?>
        <?php // echo user money ?>
        <a href="wallet.php">Dodaj środki</a>
        <a href="cart.php">Koszyk</a>
        <table>
            <thead>
            <tr>
                <th></th>
                <th>Nazwa</th>
                <th>Cena</th>
                <th>Ilość</th>
                <th?
            </tr>
            </thead>
            <tbody>
            <!--            products db-->
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php
    function moneyAdd($amount) {
        // user, db, add money
    }

    function purchase() {
        // calculate cost, remove money
        // remove products from list
        // clear cart
    }
?>