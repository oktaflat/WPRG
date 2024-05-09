<DOCTYPE! html>
<html>
<head>
    <link href="zad2.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
    <div id="all">
        <div id="form">
            <h1>Zaawansowana analiza ciągów znaków</h1>

            <form action="#" method="POST">
                <label for="string">Wpisz tekst</label><br>
                <input type="text" name="string" id="string" required><br>

                <label for="operacja">Wybierz operacje:</label><br>
                <select name="operacja" id="operacja">
                    <option value="ekstrakcja">Ekstrakcja unikalnych słów</option>
                    <option value="sortRos">Sortowanie rosnąco</option>
                    <option value="sortMal">Sortowanie malejąco</option>
                </select><br>

                <input type="submit" value="Analizuj">
            </form>

            <?php
                if(!empty($_POST["string"])) {
                    echo "<div id='wynik'><h2>Wynik</h2><br>";

                    switch($_POST["operacja"]) {
                        case "ekstrakcja":
                            $words = explode(" ", $_POST["string"]);
                            $words = array_count_values($words);

                            echo "<table><thead><tr><th>Słowo</th><th>Częstotliwość</th></tr></thead>";
                            foreach($words as $word => $count) {
                                echo "<tr><td>$word</td>";
                                echo "<td>$count</td></tr>";
                            }
                            echo "</table>";

                            break;
                        case "sortRos":
                            $words = explode(" ", $_POST["string"]);
                            sort($words, SORT_NATURAL);
                            echo implode(" ", $words);
                            break;
                        case "sortMal":
                            $words = explode(" ", $_POST["string"]);
                            rsort($words, SORT_NATURAL);
                            echo implode(" ", $words);
                            break;
                    }

                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>