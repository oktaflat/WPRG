<?php
session_start();

mysqli_report(MYSQLI_REPORT_OFF);
$dbhost = 'localhost';
$dbuser = 'tomoya';
$dbpass = 'mashiro';
$dbname = 'tomoya';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$result = $mysqli->query("SELECT * FROM GameData WHERE userID =" . $_SESSION["userID"]);
$userRow = mysqli_fetch_assoc($result);

if(isset($_POST["buyDog"]) && $userRow["hasDog"] == 0 && $userRow["coins"] >= 500) {
    $userRow["coins"] -= 500;
    $update = "UPDATE GameData SET coins = " . $userRow["coins"] . ", hasDog = 1 WHERE userID = " . $_SESSION["userID"];
    $mysqli->query($update);
}

if(isset($_POST["buyHamster"]) && $userRow["hasHamster"] == 0 && $userRow["coins"] >= 1000) {
    $userRow["coins"] -= 1000;
    $update = "UPDATE GameData SET coins = " . $userRow["coins"] . ", hasHamster = 1 WHERE userID = " . $_SESSION["userID"];
    $mysqli->query($update);
}

if(isset($_POST["buyHeal"]) && $userRow["coins"] >= 100) {
    $userRow["heal"] += 1;
    $userRow["coins"] -= 100;
    $update = "UPDATE GameData SET coins = " . $userRow["coins"] . ", heal = " . $userRow["heal"] . " WHERE userID = " . $_SESSION["userID"];
    $mysqli->query($update);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop</title>
    <link href="proj.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div class="all">
    <div id="shop">
        <div id="intro">
            <h1>Welcome to the shop!</h1>
            <p>
                Here you can unlock other characters and buy healing items.<br>
                <span class="underlined">Current balance: <span class="variable"><?php echo $userRow["coins"] ?></span></span> | <span class="underlined">Healing items: <span class="variable"><?php echo $userRow["heal"] ?></span></span>
            </p>
        </div>

        <div id="charBuyAll">
            <div class="charBuy">
                <div class="charImg" style="background-image: url('./images/dog.png')">
                    <p style="text-align: left">COST: 500</p>
                </div>
                <form action="#" method="POST">
                    <input type="submit" name="buyDog" value="Obtain DOG Character!" <?php if(isset($_POST["buyDog"]) || $userRow["hasDog"] != 0 || $userRow["coins"] < 500) echo "disabled" ?>>
                </form>
            </div>

            <div class="charBuy">
                <div class="charImg" style="background-image: url('./images/hamster.png')">
                    <p style="text-align: right">COST: 1000</p>
                </div>
                <form action="#" method="POST">
                    <input type="submit" name="buyHamster" value="Obtain HAMSTER Character!" <?php if(isset($_POST["buyHamster"]) || $userRow["hasHamster"] != 0 || $userRow["coins"] < 1000) echo "disabled" ?>>
                </form>
            </div>
        </div>

        <hr class="shopSeparation">

        <div id="healItems">
            <div class="charImg" style="background-image: url('./images/heal.png')">
                <p>COST: 100</p>
            </div>
            <form action="#" method="POST">
                <input type="submit" name="buyHeal" value="BUY" <?php if($userRow["coins"]<100) echo "disabled"?>>
            </form>
        </div>

        <hr class="shopSeparation">

        <a href="home.php">
            <button>GO BACK</button>
        </a>
    </div>
</div>
</body>
</html>
