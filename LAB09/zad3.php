<DOCTYPE! html>
<html>
<head>
    <link href="zad3.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
</head>
<body>
    <div id="all">
        <div id="main">
            <h1>Oblicz wiek i dni robocze</h1>

            <div class="form">
                <h2>Oblicz wiek i czas lokalny</h2>

                <form action="#" method="GET">
                    <input type="text" name="birthday" pattern="Data urodzenia (d-m-Y)" required>

                    <select name="timezone">
                        <option value="warsaw">Warszawa/Polska</option>
                        <option value="manila">Manila/Filipiny</option>
                        <option value="dublin">Dublin/Irlandia</option>
                    </select>

                    <input type="submit" name="birthdayAndTimezone" value="Oblicz wiek i czas">
                </form>
            </div>

            <div class="form">
                <h2>Oblicz dni robocze</h2>

                <form action="#" method="GET">
                    <input type="text" name="startdate" pattern="Data początkowa (d-m-Y)" required>
                    <input type="text" name="enddate" pattern="Data końcowa (d-m-Y)" required>
                    <input type="submit" name="workdays" value="Oblicz dni robocze">
                </form>
            </div>

            <?php
                if(isset($_GET["birthdayAndTimezone"])) {
                    echo "<p>";
                    $birthday = getdate(strtotime(trim($_GET["birthday"]))); // d-m-Y
                    $today = getdate(strtotime(date("d-m-Y")));

                    $age = $today["year"] - $birthday["year"];
                    if(($today["mon"] < $birthday["mon"]) || ($today["mon"] == $birthday["mon"] && $today["mday"] < $birthday["mday"] ))
                        $age -= 1;

                    switch($_GET["timezone"]) {
                        case "warsaw":
                            date_default_timezone_set("Europe/Warsaw");
                            break;
                        case "manila":
                            date_default_timezone_set("Asia/Manila");
                            break;
                        case "dublin":
                            date_default_timezone_set("Europe/Dublin");
                            break;
                    }

                    echo "Wiek: " . $age . " lat.<br>";
                    echo "Czas lokalny: " . date('H:m:s');
                    echo "</p>";
                }

                if(isset($_GET["workdays"])) {
                    echo "<p>";
                    if(trim($_GET["startdate"]) <= trim($_GET["enddate"])) {
                        $start = strtotime(trim($_GET["startdate"]));
                        $end = strtotime(trim($_GET["enddate"]));

                        $workdays = workdaysCalc($start, $end);
                        if ($workdays == 1)
                            echo "Ilość dni roboczych: 1 dzień.";
                        else
                            echo "Ilość dni roboczych: " . $workdays . " dni.";
                    }
                    else {
                        echo "Data początkowa odbywa się po dacie końcowej.";
                    }
                    echo "</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>

<?php
    function workdaysCalc($start, $end) {
        // dzien w roku
        $startDayOfYear = date('z', $start);
        $endDayOfYear = date('z', $end);
        // dzien tygodnia
        $startWeekday = date('N', $start);
        $endWeekday = date('N', $end);
        // ilosc wszystkich dni
        $allBetween = $endDayOfYear - $startDayOfYear;
        $workdays = 0;

        // dni robocze w tygodniach miedzy dwoma datami
        if($allBetween > 14) {
            $weeksBetween = $allBetween - (7 - $startWeekday) - $endWeekday;
            $workdays = (int) $weeksBetween - ($weeksBetween / 7) * 2;
        }
        // dni robocze dla "pierwszego" i "ostatniego" tygodnia
        $firstWeek = 5 - $startWeekday;
        $lastWeek = $endWeekday;
        if($lastWeek > 5) {
            $lastWeek -= 2;
        }
        $workdays += $firstWeek + $lastWeek;

        return $workdays;
    }
?>