<DOCTYPE! html>
<html>
<head>
    <link href="zad7.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Formularz kontaktowy</title>
<!--    http://szuflandia.pjwstk.edu.pl/~s30303/zad7.php-->
</head>
<body>
    <div id="all">
        <div id="form">
            <form action="#" method="POST">
                <input type="text" name="fullname" placeholder="Twoje imię i nazwisko" required><br>
                <input type="text" name="email" placeholder="Twój email" pattern="^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$" required><br>
                <input type="text" name="phone" placeholder="Twój telefon" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" required><br>

                <select name="temat" required>
                    <option value="" disabled selected hidden>Wybierz temat</option>
                    <option value="temat1">Temat 1</option>
                    <option value="temat2">Temat 2</option>
                </select><br>

                <label>Wybierz opcje:</label><br>
                <input type="checkbox" value="opcja1" name="opcja1" id="opcja1_1">
                <label for="opcja1_1">Opcja 1</label>
                <input type="checkbox" value="opcja2" name="opcja1" id="opcja1_2">
                <label for="opcja1_2">Opcja 2</label><br>

                <label>Wybierz jedną opcję:</label><br>
                <input type="radio" value="opcja1" name="opcja2" id="opcja2_1" required>
                <label for="opcja2_1">Opcja 1</label>
                <input type="radio" value="opcja2" name="opcja2" id="opcja2_2">
                <label for="opcja2_2">Opcja 2</label><br>

                <input type="submit" value="Wyślij">
            </form>

            <?php
                if(!empty($_POST["temat"])) {
                    echo "<hr><p><ul>";

                    $contact = array($_POST["fullname"], $_POST["email"], $_POST["phone"], $_POST["temat"], $_POST["opcja1"], $_POST["opcja2"]);
                    foreach($contact as $info) {
                        echo "<li>" . $info . "</li>";
                    }

                    echo "</ul></p>";
                }
            ?>
        </div>
    </div>
</body>
</html>