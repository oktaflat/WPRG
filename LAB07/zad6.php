<DOCTYPE! html>
<html>
<head>
    <link href="zad6.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <title>Wielkanoc</title>
</head>
<body>
<div id="all">
    <div id="kalkulator">
        <p>Aby obliczyć datę Wielkanocy dla podanego roku, wprowadź rok poniżej:</p>
        <form action="#" method="GET">
            <label for="rok">Wprowadź rok:</label>
            <input type="text" name="rok" required><br>
            <input type="submit" value="Oblicz">
        </form>

        <?php
            if(!empty($_GET["rok"])) {
                echo "<p>";

                $working = true;
                $year = $_GET["rok"];
                switch(true){
                    case(in_array($year, range(1,1582))):
                        $x = 15;
                        $y = 6;
                        break;
                    case(in_array($year, range(1583,1699))):
                        $x = 22;
                        $y = 2;
                        break;
                    case(in_array($year, range(1700,1799))):
                        $x = 23;
                        $y = 3;
                        break;
                    case(in_array($year, range(1800,1899))):
                        $x = 23;
                        $y = 4;
                        break;
                    case(in_array($year, range(1900,2099))):
                        $x = 24;
                        $y = 5;
                        break;
                    case(in_array($year, range(1,1582))):
                        $x = 24;
                        $y = 6;
                        break;
                    default:
                        echo "Nieprawidłowy rok.";
                        $working = false;
                        break;
                }

                if($working == true) {
                    echo "Data wielkanocy dla roku " . $_GET["rok"] . " to <em>";
                    $a = $year % 19;
                    $b = $year % 4;
                    $c = $year % 7;
                    $d = (19 * $a + $x) % 30;
                    $e = (2 * $b + 4 * $c + 6 * $d + $y) % 7;

                    if($e == 6) {
                        if($d == 26)
                            echo "26 kwietnia.";
                        else if($d == 28 && ((11 * $x + 11) % 30 < 19))
                            echo "18 kwietnia.";
                    }
                    if(($d + $e) < 10) {
                        echo (22 + $d + $e) . " marca.";
                    }
                    else {
                        echo ($d + $e - 9) . " kwietnia.";
                    }
                }

                echo "</em></p>";
            }
        ?>
    </div>
</div>
</body>
</html>