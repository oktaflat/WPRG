<?php
session_start();

mysqli_report(MYSQLI_REPORT_OFF);
$dbhost = 'localhost';
$dbuser = 'tomoya';
$dbpass = 'mashiro';
$dbname = 'tomoya';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

//SETUP
$setup = false;
if(isset($_GET["characterCat"])) {
    $_SESSION["character"] = "Cat";
    $setup = true;
}
if(isset($_GET["characterDog"])) {
    $_SESSION["character"] = "Dog";
    $setup = true;
}
if(isset($_GET["characterHamster"])) {
    $_SESSION["character"] = "Hamster";
    $setup = true;
}

if($setup == true) {
    $_SESSION["battleWave"] = 1;
    $_SESSION["turnCount"] = 1;

    $player = mysqli_fetch_assoc($mysqli->query("SELECT * FROM Characters WHERE name = '" . $_SESSION["character"] . "'"));
    $_SESSION["playerHP"] = $player["HP"];

    $smallEnemy = mysqli_fetch_assoc($mysqli->query("SELECT * FROM Enemies WHERE name='Small Enemy'"));
    $_SESSION["enemyOneID"] = $smallEnemy["enemyID"];
    $_SESSION["enemyTwoID"] = $smallEnemy["enemyID"];

    $bossID = rand(2,3);
    $bossEnemy = mysqli_fetch_assoc($mysqli->query("SELECT * FROM Enemies WHERE enemyID = " . $bossID));
    $_SESSION["enemyBossID"] = $bossEnemy["enemyID"];

    $_SESSION["currentEnemyID"] = $_SESSION["enemyOneID"];
    $_SESSION["currentEnemyHP"] = $smallEnemy["HP"];
    $_SESSION["coins"] = 0;
    $_SESSION["ongoingBattle"] = true;
    $_SESSION["victory"] = null;
    header("location:battle.php");
}

// DAMAGE
$user = mysqli_fetch_assoc($mysqli->query("SELECT * FROM GameData WHERE userID = " . $_SESSION["userID"]));
$player = mysqli_fetch_assoc($mysqli->query("SELECT * FROM Characters WHERE name = '" . $_SESSION["character"] . "'"));
$currentEnemy = mysqli_fetch_assoc($mysqli->query("SELECT * FROM Enemies WHERE enemyID = " . $_SESSION["currentEnemyID"]));

if(isset($_POST["attack"])) {
    $playerAttack = attack($player, $currentEnemy);
    $enemyAttack = attack($currentEnemy, $player);
    if($enemyAttack < 0)
        $enemyAttack = 0;
    if($player["SPD"] >= $currentEnemy["SPD"]) {
        $_SESSION["currentEnemyHP"] -= $playerAttack;
        $_SESSION["playerHP"] -= $enemyAttack;
    }
    else {
        $_SESSION["playerHP"] -= $enemyAttack;
        $_SESSION["currentEnemyHP"] -= $playerAttack;
    }
    $_SESSION["turnCount"] += 1;
}

if(isset($_POST["skill"])) {
    switch($_SESSION["character"]) {
        case "Cat":
            $playerAttack = attack($player, $currentEnemy) + 15;
            $_SESSION["currentEnemyHP"] -= $playerAttack;
            $enemyAttack = attack($currentEnemy, $player) + 5;
            $_SESSION["playerHP"] -= $enemyAttack;
            break;
        case "Dog":
            $playerAttack = attack($player, $currentEnemy) + 15;
            $_SESSION["currentEnemyHP"] -= $playerAttack;
            $enemyAttack = attack($currentEnemy, $player) - 30;
            if($enemyAttack > 0)
                $_SESSION["playerHP"] -= $enemyAttack;
            break;
        case "Hamster":
            $_SESSION["currentEnemyHP"] = 1;
            $_SESSION["playerHP"] = $player["HP"];
            break;
    }
    $_SESSION["turnCount"] += 1;
}

if(isset($_POST["heal"])) {
    if($user["heal"] > 0) {
        $user["heal"]--;
        $mysqli->query("UPDATE GameData SET heal = " . $user["heal"] . " WHERE userID = " . $_SESSION["userID"]);
        $_SESSION["playerHP"] += 30;
        $_SESSION["playerHP"] -= attack($currentEnemy, $player);
    }
    $_SESSION["turnCount"] += 1;
}

if($_SESSION["playerHP"] < 0)
    $_SESSION["playerHP"] = 0;
if($_SESSION["currentEnemyHP"] < 0)
    $_SESSION["currentEnemyHP"] = 0;

// UPDATE
$updateHP = false;
if($_SESSION["currentEnemyHP"] <= 0) {
    if($_SESSION["battleWave"] < 4) {
        $_SESSION["battleWave"]++;
        $coins = rand(50,100);
        $_SESSION["coins"] += $coins;
        $updateHP = true;
    }
}

switch($_SESSION["battleWave"]) {
    case 1:
        $_SESSION["currentEnemyID"] = $_SESSION["enemyOneID"];
        break;
    case 2:
        $_SESSION["currentEnemyID"] = $_SESSION["enemyTwoID"];
        break;
    case 3:
        $_SESSION["currentEnemyID"] = $_SESSION["enemyBossID"];
        break;
    case 4:
        $_SESSION["ongoingBattle"] = false;
        $_SESSION["victory"] = true;
        break;
}
$currentEnemy = mysqli_fetch_assoc($mysqli->query("SELECT * FROM Enemies WHERE enemyID = " . $_SESSION["currentEnemyID"]));
if($updateHP == true) {
    $_SESSION["currentEnemyHP"] = $currentEnemy["HP"];
}

// WIN
if($_SESSION["ongoingBattle"] == false && $_SESSION["victory"] == true) {
    $_SESSION["battleWave"] = 3;
    $_SESSION["currentEnemyHP"] = 0;

    $coins = $_SESSION["coins"];
    $_SESSION["coins"] = 0;
    $user["coins"] += $coins;
    $mysqli->query("UPDATE GameData SET coins = " . $user["coins"] . " WHERE userID = " . $_SESSION["userID"]);
}

// LOSE
if(isset($_POST["run"]) || $_SESSION["playerHP"] == 0) {
    $_SESSION["ongoingBattle"] = false;
    $_SESSION["victory"] = false;
}
if($_SESSION["ongoingBattle"] == false && $_SESSION["victory"] == false) {
    $_SESSION["coins"] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>BATTLE</title>
    <link href="proj.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div class="all">
    <div id="game">
        <div id="windowTop">
            <ul>
                <li class="underlined">Your HP: <span class="variable"><?php echo $_SESSION["playerHP"] ?></span></li>
                <li>|</li>
                <li class="underlined">Turn count: <span class="variable"><?php echo $_SESSION["turnCount"]?></span></li>
                <li>|</li>
                <li class="underlined">Wave count: <span class="variable"><?php echo $_SESSION["battleWave"]?> / 3</span></li>
                <li>|</li>
                <li class="underlined">Enemy HP: <span class="variable"><?php echo $_SESSION["currentEnemyHP"] ?></span></li>
            </ul>
        </div>

        <div id="window">
            <img id="player" src="<?php echo $player['image'] ?>">
            <img id="enemy" src="<?php echo $currentEnemy['image'] ?>">
        </div>

        <?php if($_SESSION["ongoingBattle"] == true): ?>
        <form action="#" method="POST">
            <input type="submit" name="attack" value="ATTACK">
            <input type="submit" name="skill" value="SKILL"><br>
            <input type="submit" name="heal" value="HEAL" <?php if($user["heal"] == 0) echo "disabled"?>>
            <input type="submit" name="run" value="RUN">
        </form>
        <?php endif; ?>

        <?php if($_SESSION["ongoingBattle"] == false && $_SESSION["victory"] == true): ?>
        <p>
            You've earned <?php echo $coins ?> coins!<br>
            <a href="home.php">
                <button>GO BACK</button>
            </a>
        </p>
        <?php endif; ?>

        <?php if($_SESSION["ongoingBattle"] == false && $_SESSION["victory"] == false): ?>
            <p>
                You lost! <a href="charselect.php">Try again?</a>
            </p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
<?php
    function attack($characterData, $opponentData) {
        $critChance = rand(1, 100);
        if($critChance > 90)
            return $characterData["ATK"] - $opponentData["DEF"] / 3;
        else
            return $characterData["ATK"] - $opponentData["DEF"] / 2;
    }
?>