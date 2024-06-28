<?php
session_start();

mysqli_report(MYSQLI_REPORT_OFF);
$dbhost = 'localhost';
$dbuser = 'tomoya';
$dbpass = 'mashiro';
$dbname = 'tomoya';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

$codes = ["debug", "capybara", "moneymoneymoney", "DROPDATABASE"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Code Input (Cheats)</title>
    <link href="proj.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div class="all">
    <div id="code">
        <form action="#" method="POST">
            <label for="codeInput">Input your code here!!! One at a time please :]</label><br>
            <input type="text" name="codeInput" id="codeInput"><br>
            <input type="submit" value="REDEEM">
        </form>
        <a href="home.php">
            <button>GO BACK</button>
        </a>
        <?php
        if(isset($_POST["codeInput"])) {
            echo "<hr>";
            switch($_POST["codeInput"]) {
                case "debug":
                    unlockEverything($_SESSION["userID"], $mysqli);
                    echo "Unlocked all characters.";
                    break;
                case "moneymoneymoney":
                    addMoney($_SESSION["userID"], $mysqli);
                    echo "Added 2000 coins to account.";
                    break;
                case "reset":
                    resetAccount($_SESSION["userID"], $mysqli);
                    echo "Reset account.";
                    break;
                case "DROPDATABASE":
                    resetAll($mysqli);
                    echo "Reset all tables.";
                    break;
                case "capybara":
                    capybaraMode();
                    break;
                default:
                    echo "Can't redeem code!";
            }
        }
        ?>
    </div>

    <div id="hiddenCodes">
        <p>Working codes list:</p>
        <ul>
            <li>debug &#8212; unlocks everything</li>
            <li>moneymoneymoney &#8212; gives 2000 coins</li>
            <li>reset &#8212; account reset</li>
            <li>DROPDATABASE &#8212; deletes all tables</li>
        </ul>
    </div>
</div>
</body>
</html>
<?php
    function unlockEverything($userID, $mysqli) {
        $update = "UPDATE GameData SET hasDog = 1, hasHamster = 1 WHERE userID = " . $userID;
        $mysqli->query($update);
    }

    function addMoney($userID, $mysqli) {
        $userSelect = $mysqli->query("SELECT * FROM GameData WHERE userID = " . $userID);
        $userRow = mysqli_fetch_assoc($userSelect);
        $coins = $userRow["coins"] + 2000;
        $update = "UPDATE GameData SET coins = " . $coins . " WHERE userID = " . $userID;
        $mysqli->query($update);
    }

    function resetAccount($userID, $mysqli) {
        $update = "UPDATE GameData SET coins = 0, heal = 0, hasDog = 0, hasHamster = 0, lastUsedCharacter = 'Cat' WHERE userID = " . $userID;
        $mysqli->query($update);
    }

    function resetAll($mysqli) {
        $dropTables = "DROP TABLE IF EXISTS Characters, Enemies, Records, GameData, Users";
        $mysqli->query($dropTables);
        session_unset();
        header("location:login.php");
    }

    function capybaraMode() {
        if($_SESSION["capybaraMode"] == false) {
            $_SESSION["capybaraMode"] = true;
            echo "The balance has shifted...";
        }
        else {
            $_SESSION["capybaraMode"] = false;
            echo "The balance has been restored";
        }
    }
?>