<!DOCTYPE html>
<html>
<head>
    <link href="zad4.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Kalkulator zbiorów</title>
</head>
<body>
    <div class="main">
        <h1>Kalkulator zbiorów</h1>
        <div class="form">
            <form action="#" method="GET">
                <label for="zbiorA">Zbiór A (liczby oddzielone przecinkami):</label><br>
                <input name="zbiorA" type="text" required><br>

                <label for="zbiorB">Zbiór B (liczby oddzielone przecinkami):</label><br>
                <input name="zbiorB" type="text" required><br>

                <label for="operacja">Operacja:</label><br>
                <select name="operacja">
                    <option value="suma">Suma</option>
                    <option value="roznica">Różnica</option>
                    <option value="wspolna">Część wspólna</option>
                </select><br>

                <input type="submit" value="Oblicz">
            </form>
        </div>
        <?php
            if(!empty($_GET["zbiorA"]) && !empty($_GET["zbiorB"])) {
                echo "<div class='form result'>";

                $a = explode(",", $_GET["zbiorA"]);
                $b = explode(",", $_GET["zbiorB"]);
                $c = [];

                switch ($_GET["operacja"]) {
                    case "suma":
                        $c = array_merge($a, $b);
                        break;
                    case "roznica":
                        $c = array_diff($a, $b);
                        break;
                    case "wspolna":
                        $c = array_intersect($a, $b);
                        break;
                }
                print_r(array_values($c));
            }
        ?>
    </div>
</body>
</html>