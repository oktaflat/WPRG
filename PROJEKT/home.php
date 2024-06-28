<?php
session_start();
if($_SESSION["userID"] == null) {
    header("location:login.php");
}

mysqli_report(MYSQLI_REPORT_OFF);
$dbhost = 'localhost';
$dbuser = 'tomoya';
$dbpass = 'mashiro';
$dbname = 'tomoya';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$result = $mysqli->query("SELECT * FROM Users INNER JOIN GameData ON Users.userID = GameData.userID WHERE Users.userID =" . $_SESSION["userID"]);
$userRow = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home page :]</title>
    <link href="proj.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div class="all">
    <div id="header">
        <ul>
            <li class="big">Hello <span class="variable"><?php echo $userRow["username"] ?></span>, have a great <em><?php echo date('l') ?></em>!</li>
            <li>|</li>
            <li class="underlined"><span class="variable"><?php echo $userRow["coins"] ?></span> coins</li>
            <li>|</li>
            <li class="underlined"><span class="variable"><?php echo $userRow["heal"] ?></span> healing items</li>
            <li>
                <form action="login.php" method="POST">
                    <input type="submit" name="logout" value="LOG OUT">
                </form>
            </li>
        </ul>
    </div>

    <div id="nav">
        <a href="charselect.php">
            <button id="game">START GAME &#9734;</button>
        </a><br>

        <a href="shop.php">
            <button>SHOP</button>
        </a><br>

        <a href="codes.php">
            Have a <em>code...</em>?
        </a>
    </div>
</div>
</body>
</html>