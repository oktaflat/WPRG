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

    $sqlPersons = "CREATE TABLE Persons(Person_id INT PRIMARY KEY, Person_firstname VARCHAR(255), Person_secondname VARCHAR(255), Person_email VARCHAR(255));";
    $sqlCars = "CREATE TABLE Cars(Cars_id INT PRIMARY KEY, Cars_model VARCHAR(255), Cars_price FLOAT, Cars_day_of_buy DATETIME, Person_id INT, FOREIGN KEY (Person_id) REFERENCES Persons(Person_id));";

    if ($mysqli->query($sqlPersons)) {
        printf("Table Persons created successfully.<br />");
    }
    else {
        printf("Table Persons already exists<br>");
    }
    if ($mysqli->query($sqlCars)) {
        printf("Table Cars created successfully.<br />");
    }
    else {
        printf("Table Cars already exists<br>");
    }
?>

<DOCTYPE! html>
<html>
    <link href="zad2.css" rel="stylesheet" type="text/css">
</html>
<body>
    <div id="main">
        <h1>Manage MySQL Database</h1>

        <div class="form">
            <form action="#" method="POST">
                <label>Add Person</label><br>
                <input type="text" name="firstname" placeholder="First Name"><br>
                <input type="text" name="lastname" placeholder="Last Name"><br>
                <input type="text" name="email" placeholder="Email"><br>
                <input type="submit" name="submitPerson" value="Add Person">
            </form>
        </div>

        <div class="form">
            <form action="#" method="POST">
                <label>Add Car</label><br>
                <input type="text" name="model" placeholder="Model"><br>
                <input type="text" name="Year" placeholder="Year"><br>
                <select name="selectedPerson">
                    <option value="" disabled selected>Select Person</option>
                    <?php selectPerson(); ?>
                </select><br>
                <input type="submit" name="submitCar" value="Add Car">
            </form>
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php makeTable("Persons", $mysqli); ?>
                </tbody>
            </table>
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Person ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php makeTable("Cars", $mysqli); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<?php
    function selectPerson() {

    }

    function makeTable($name, $mysqli) {
        if($name === "Persons") {
            $sql = "SELECT Person_id, Person_firstname, Person_secondname, Person_email FROM Persons";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    printf("Id: %s, Title: %s, Author: %s, Date: %d <br />", $row["tutorial_id"], $row["tutorial_title"], $row["tutorial_author"], $row["submission_date"]);
                }
            } else {
                printf('No record found.<br />');
            }
        }
    }
?>