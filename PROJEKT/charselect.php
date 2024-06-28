<?php
session_start();
$_SESSION["ongoingBattle"] = false;
$_SESSION["battleWave"] = 0;

mysqli_report(MYSQLI_REPORT_OFF);
$dbhost = 'localhost';
$dbuser = 'tomoya';
$dbpass = 'mashiro';
$dbname = 'tomoya';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$charactersTable = "CREATE TABLE Characters(characterID INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(10) NOT NULL, image VARCHAR(50), HP INT NOT NULL, ATK INT NOT NULL, DEF INT NOT NULL, SPD INT NOT NULL)";
if($mysqli->query($charactersTable)) {
    $mysqli->query("INSERT INTO Characters (name, image, HP, ATK, DEF, SPD) VALUES ('Cat', './images/cat.png', 100, 50, 50, 50), ('Dog', './images/dog.png', 120, 40, 60, 30), ('Hamster', './images/hamster.png', 90, 40, 30, 70)");
}

$enemiesTable = "CREATE TABLE Enemies(enemyID INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30) NOT NULL, image VARCHAR(50), HP INT NOT NULL, ATK INT NOT NULL, DEF INT NOT NULL, SPD INT NOT NULL)";
if($mysqli->query($enemiesTable)) {
    $mysqli->query("INSERT INTO Enemies (name, image, HP, ATK, DEF, SPD) VALUES ('Small Enemy', './images/smallEnemy.png', 70, 10, 20, 40), ('Tomoya', './images/tomoya.png', 140, 40, 40, 70), ('Kohane', './images/kohane.png', 160, 50, 20, 80)");
}

$result = $mysqli->query("SELECT * FROM GameData WHERE userID =" . $_SESSION["userID"]);
$userRow = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Select Character | BATTLE</title>
    <link href="proj.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div class="all">
    <div id="charSelectAll">
        <div class="charSelect">
            <div class="charImg" style="background-image: url('./images/cat.png')">
                <p>
                    <span class="charName">CAT</span><br>
                    HP: 100<br>
                    ATK: 30<br>
                    DEF: 40<br>
                    SPD: 50<br>
                </p>
            </div>
            <form action="battle.php" method="GET">
                <input type="submit" name="characterCat" value="PLAY AS CAT">
            </form>
        </div>

        <div class="charSelect">
            <div class="charImg" style="background-image: url('./images/dog.png')">
                <p style="text-align: left">
                    <span class="charName">DOG</span><br>
                    HP: 120<br>
                    ATK: 20<br>
                    DEF: 60<br>
                    SPD: 30<br>
                </p>
            </div>
            <form action="battle.php" method="GET">
                <input type="submit" name="characterDog" value="PLAY AS DOG" <?php if($userRow["hasDog"] == 0) echo "disabled" ?>>
            </form>
        </div>

        <div class="charSelect">
            <div class="charImg" style="background-image: url('./images/hamster.png')">
                <p>
                    <span class="charName">HAMSTER</span><br>
                    HP: 90<br>
                    ATK: 40<br>
                    DEF: 15<br>
                    SPD: 70<br>
                </p>
            </div>
            <form action="battle.php" method="GET">
                <input type="submit" name="characterHamster" value="PLAY AS HAMSTER" <?php if($userRow["hasHamster"] == 0) echo "disabled" ?>>
            </form>
        </div>

        <hr id="charselectSeparation">

        <a href="home.php">
            <button>GO BACK</button>
        </a>
    </div>
</div>
</body>
</html>
