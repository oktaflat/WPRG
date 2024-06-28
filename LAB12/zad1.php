<?php
    mysqli_report(MYSQLI_REPORT_OFF);

    $dbhost = 'szuflandia.pjwstk.edu.pl';
    $dbuser = 's30303';
    $dbpass = 'Jul.Prug';
    $dbname = 's30303';

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($mysqli->connect_errno) {
        printf(
            "Connect failed: %s<br />", $mysqli->connect_error);
        exit();
    }

    $sql = "CREATE TABLE Students(" .
        "StudentID INT PRIMARY KEY, " .
        "Firstname VARCHAR(255), " .
        "Secondname VARCHAR(255), " .
        "Salary INT, " .
        "DateOfBirth DATE)";
    $mysqli->query($sql);
?>
<DOCTYPE! html>
<html>
<head>
    <link href="zad1.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div>
        <h1>Manage MySQL Table</h1>

        <form action="#" method="GET">
            <input type="submit" value="Delete table" name="killTable">
        </form>
<?php
mysqli_report(MYSQLI_REPORT_OFF);

$dbhost = 'szuflandia.pjwstk.edu.pl';
$dbuser = 's30303';
$dbpass = 'Jul.Prug';
$dbname = 's30303';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($mysqli->connect_errno) {
    printf(
        "Connect failed: %s<br />", $mysqli->connect_error);
    exit();
}

$sql = "CREATE TABLE Students(" .
    "StudentID INT PRIMARY KEY, " .
    "Firstname VARCHAR(255), " .
    "Secondname VARCHAR(255), " .
    "Salary INT, " .
    "DateOfBirth DATE)";
if ($mysqli->query($sql)) {
    printf("Table Students created successfully.<br />");
}

if (isset($_GET["killTable"])) {
    if($mysqli->errno) {
        if ($mysqli->query("DROP TABLE Students")) {
            printf("Table Students dropped succesfully");
        } else {
            printf("Could not delete table: %s<br />", $mysqli->error);
        }
        header("location:zad1.php");
    }
}
$mysqli->close();
?>
    </div>
</body>
</html>
