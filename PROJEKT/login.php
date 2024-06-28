<?php
session_start();
mysqli_report(MYSQLI_REPORT_OFF);

$dbhost = 'localhost';
$dbuser = 'tomoya';
$dbpass = 'mashiro';
$dbname = 'tomoya';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$usersTable = "CREATE TABLE Users(userID INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL)";
$gameDataTable = "CREATE TABLE GameData(userID INT, coins INT DEFAULT 0, heal INT DEFAULT 0, hasDog BOOLEAN DEFAULT false, hasHamster BOOLEAN DEFAULT false, lastUsedCharacter VARCHAR(6) DEFAULT 'Cat', FOREIGN KEY (userID) REFERENCES Users(userID))";
if($mysqli->query($usersTable)) {
    $mysqli->query($gameDataTable);
    echo "Creating Users database...";
    header("location:login.php");
}

if(isset($_POST["logout"])) {
    $mysqli->query("UPDATE GameData SET lastUsedCharacter = '" . $_SESSION["character"] . "' WHERE userID = " . $_SESSION["userID"]);
    $_SESSION["capybaraMode"] = false;
    session_unset();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login page!!!</title>
    <link href="proj.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div class="all">
    <div id="login">
        <form action="#" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br>

            <input type="submit" value="Log in" name="login">
            <input type="submit" value="Register" name="register">
        </form>

        <?php
        if(isset($_POST["login"])) {
            $username = trim($_POST["username"]);
            $result = $mysqli->query("SELECT * FROM Users INNER JOIN GameData ON Users.userID = GameData.userID WHERE username = '" . $username . "'");
            if(mysqli_num_rows($result) == 1) {
                $userRow = mysqli_fetch_assoc($result);
                if($userRow["password"] === $_POST["password"]) {
                    $_SESSION["userID"] = $userRow["userID"];
                    $_SESSION["character"] = $userRow["lastUsedCharacter"];
                    echo "Logged in!";
                    header("location:home.php");
                }
                else {
                    echo "Wrong password.";
                }
            }
            else {
                echo "User doesn't exist.";
            }
        }


        if(isset($_POST["register"])) {
            $username = trim($_POST["username"]);
            $result = $mysqli->query("SELECT * FROM Users WHERE username = '" . $username . "';");
            if(mysqli_num_rows($result) == 0) {
                if($mysqli->query("INSERT INTO Users (username, password) VALUES ('" . $username . "','" . $_POST["password"] . "');")) {
                    $mysqli->query("INSERT INTO GameData (userID) VALUES (" . $mysqli->insert_id . ")");
                    echo "User created!";
                }
                else {
                    echo "Something went wrong!";
                }
            }
            else {
                echo "User already exists.";
            }
        }
        ?>
    </div>
</div>
</body>
</html>