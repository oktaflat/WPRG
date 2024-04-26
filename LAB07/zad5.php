<DOCTYPE! html>
<html>
<head>
    <link href="zad5.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Kalkulator</title>
</head>
<body>
<div id="all">
    <div id="kalkulator">
        <h1>Kalkulator</h1>

        <hr>

        <div id="prosty">
            <h2>Prosty</h2>
            <form action="#" method="GET">
                <input name="liczba1" type="text" required>

                <select name="operacjaP">
                    <option value="dodawanie">Dodawanie</option>
                    <option value="odejmowanie">Odejmowanie</option>
                    <option value="mnozenie">Mnożenie</option>
                    <option value="dzielenie">Dzielenie</option>
                </select>

                <input name="liczba2" type="text" required><br>

                <input type="submit" value="Oblicz">
            </form>

            <?php
                if(!empty($_GET["liczba1"]) || !empty($_GET["liczba2"])) {
                    if(empty($_GET["liczba1"]))
                        $_GET["liczba1"] = 0;
                    if(empty($_GET["liczba2"]))
                        $_GET["liczba2"] = 0;
                    $_GET["liczba1"] = str_replace(",",".", $_GET["liczba1"]);
                    $_GET["liczba2"] = str_replace(",",".", $_GET["liczba2"]);

                    echo "<p class='wynik'>";
                    echo "<h3>Wynik</h3>";

                    switch($_GET["operacjaP"]) {
                        case "dodawanie":
                            echo "= " . $_GET["liczba1"] + $_GET["liczba2"];
                            break;
                        case "odejmowanie":
                            echo "= " . $_GET["liczba1"] - $_GET["liczba2"];
                            break;
                        case "mnozenie":
                            echo "= " . $_GET["liczba1"] * $_GET["liczba2"];
                            break;
                        case "dzielenie":
                            if($_GET["liczba2"] == 0)
                                echo "Nie można dzielić przez 0";
                            else
                                echo "= " . $_GET["liczba1"] / $_GET["liczba2"];
                            break;
                    }

                    echo "</p>";
                }
            ?>
        </div>

        <hr>

        <div id="zaawansowany">
            <h2>Zaawansowany</h2>
            <form action="#" method="GET">
                <input name="liczbaZ" type="text">

                <select name="operacjaZ">
                    <option value="cos">Cosinus</option>
                    <option value="sin">Sinus</option>
                    <option value="tan">Tangens</option>
                    <option value="binToDec">Binarne na dziesiętne</option>
                    <option value="decToBin">Dziesiętne na binarne</option>
                    <option value="decToHex">Dziesiętne na szesnastkowe</option>
                    <option value="hexToDec">Szesnastkowe na dziesiętne</option>
                </select><br>

                <input type="submit" value="Oblicz">
            </form>

            <?php
                if(!empty($_GET["liczbaZ"])) {
                    echo "<p class='result'>";
                    echo "<h3>Wynik</h3>";

                    switch($_GET["operacjaZ"]) {
                        case "cos":
                            echo "= " . cos($_GET["liczbaZ"]);
                            break;
                        case "sin":
                            echo "= " . sin($_GET["liczbaZ"]);
                            break;
                        case "tan":
                            echo "= " . tan($_GET["liczbaZ"]);
                            break;
                        case "binToDec":
                            echo "= " . bindec($_GET["liczbaZ"]);
                            break;
                        case "decToBin":
                            echo "= " . decbin($_GET["liczbaZ"]);
                            break;
                        case "decToHex":
                            echo "= " . dechex($_GET["liczbaZ"]);
                            break;
                        case "hexToDec":
                            echo "= " . hexdec($_GET["liczbaZ"]);
                            break;
                    }

                    echo "</p>";
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>