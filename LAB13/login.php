<?php
    session_start();
    $dbhost = 'szuflandia.pjwstk.edu.pl';
    $dbuser = 's30303';
    $dbpass = 's30303';
    $dbname = 'Users';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($mysqli->connect_errno) {
        printf(
        "Connect failed: %s<br />", $mysqli->connect_error);
        exit();
    }
    initialDBCreation($mysqli);

    if(isset($_POST["username"])) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
        if (isset($_POST["login"])) {
            // double check with database
            // if only one thing wrong, incorrect if both - option to sign up
            // if both correct
                header("location:storefront.php");
        }
        if (isset($_POST["signup"])) {
            // double check with database
            // if username already exists - cant create
            // if username not used, create
            // report error
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Sklep internetowy - Logowanie</title>
    <link href="lab13.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
<div id="all">
    <?php
        if (isset($_POST["signup"]))
            echo "<p>Użytkownik " . $_SESSION["username"] . " został stworzony.</p>";
    ?>
    <div id="form">
        <form action="#" method="POST">
            <label for="username">Użytkownik:</label>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Hasło:</label>
            <input type="password" name="password" id="password" required><br>

            <input type="submit" name="login" value="Log in">
            <input type="submit" name="signup" value="Sign up">
        </form>
    </div>
</div>
</body>
</html>
<?php
    function initialDBCreation($mysqli) {
        $sqlUsers = "CREATE TABLE Users(user_id INT PRIMARY KEY, username VARCHAR(100), password VARCHAR(100), money DECIMAL(6,2));";
        if($mysqli->query($sqlUsers)){
            $sqlProducts = "CREATE TABLE Products(product_id INT PRIMARY KEY, name VARCHAR(100), price (DECIMAL 5,2), amount INT);";
            $mysqli->query($sqlProducts);
            $sqlCarts = "CREATE TABLE Carts(cart_id INT PRIMARY KEY, user_id INT, );";
            $mysqli->query($sqlCarts);
        }
        else {
            exit();
        }
    }
?>