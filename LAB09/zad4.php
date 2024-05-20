<DOCTYPE! html>
<html>
<head>
    <link href="zad4.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
</head>
<body>
    <div id="all">
        <div id="main">
            <h1>Zarządzanie opiniami</h1>

            <form action="#" method="POST">
                <textarea cols="30" rows="7" name="text" placeholder="Wpisz swoją opinię" required></textarea><br>
                <input type="submit" name="opinionAdd" value="Dodaj opinię">
            </form>
            <?php
                if(isset($_POST["opinionAdd"])) {
                    addOpinion($_POST["text"]);
                }
            ?>

            <div id="allOpinions">
                <h2>Opinie: </h2>
                <?php
                    $allData = file("opinie.txt");
                    clearstatcache();
                    if(0 != filesize("opinie.txt")) {
                        $key = $allData[count($allData) - 1];
                        $startOfOpinion = opinionStart($allData, $key);

                        foreach ($startOfOpinion as $beginning) {
                            echo "<hr><div class='opinion'>";
                            echo "<p>";
                            readOpinion($allData, $beginning, $key);
                            echo "</p>";
                            echo "<form action='#' method='POST'>";
                            echo "<input type='submit' class='reset' name='reset" . $beginning . "' value='Usuń'>";
                            echo "</form>";

                            if (isset($_POST["reset" . $beginning])) {
                                deleteOpinion($allData, $beginning, $key);
                                header("location:zad4.php");
                            }
                            echo "</div>";
                        }
                    }
                ?>


                <form action="#" method="POST">
                    <br><input type="submit" name="resetAll" value="Resetuj wszystko">
                </form>
                <?php
                    if(isset($_POST["resetAll"])) {
                        resetAll();
                        header("location:zad4.php");
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    function addOpinion($text) {
        $file = fopen("opinie.txt", 'a');
        fwrite($file, "\n" . $text . "\n");
        fwrite($file, date("d.m.Y") . "\n");
        fwrite($file, "#### END OF OPINION");
        fclose($file);
    }

    function opinionStart($data, $key) {
        $start[] = 0;
        for($i = 0; $i < count($data); $i++) {
            if(strpos($data[$i], $key) !== false)
                $start[] = $i + 1;
        }
        array_pop($start);
        return $start;
    }

    function readOpinion($data, $beginning, $key) {
        $line = $beginning - 1;
        while(1) {
            $line++;
            if(strpos($data[$line], $key) !== false) {
                break;
            }
            echo $data[$line] . "<br>";
        }
    }

    function deleteOpinion($data, $beginning, $key) {
        $newData = [];
        for($i = 0; $i < count($data); $i++) {
            if($i == $beginning) {
                while(1) {
                    if(strpos($data[$i], $key) === false)
                        $i++;
                    else
                        break;
                }
            }
            else {
                $newData[] = $data[$i];
            }
        }
        file_put_contents("opinie.txt", $newData);
    }

    function resetAll() {
        $file = fopen("opinie.txt", 'w');
        fclose($file);
    }
?>