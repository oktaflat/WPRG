<DOCTYPE! html>
<html>
<head>
    <link href="zad1.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
    <div id="all">
        <div id="form">
            <form action="#" method="POST">
                <label for="string">Wpisz tekst:</label><br>
                <input type="text" name="string" id="string" required><br>
                <label for="operacja">Wybierz operacje</label><br>

                <select name="operacja" id="operacja">
                    <option value="odwroc">Odwróć ciąg znaków</option>
                    <option value="wielkie">Zamień wszystkie litery na wielkie</option>
                    <option value="male">Zamień wszystkie litery na małe</option>
                    <option value="policz">Policz liczbę znaków</option>
                    <option value="usunbiale">Usuń białe znaki z początku i końca ciągu</option>
                </select><br>

                <input type="submit" value="Wykonaj">
            </form>
        </div>
        <div id="wynik">
            <p>Wynik:
            <?php
                if(!empty($_POST["string"])) {
                    switch($_POST["operacja"]) {
                        case "odwroc":
                            echo strrev($_POST["string"]);
                            break;
                        case "wielkie":
                            echo strtoupper($_POST["string"]);
                            break;
                        case "male":
                            echo strtolower($_POST["string"]);
                            break;
                        case "policz":
                            echo strlen($_POST["string"]);
                            break;
                        case "usunbiale":
                            echo trim($_POST["string"]);
                            break;
                    }
                }
            ?>
            </p>
        </div>
    </div>
</body>
</html>