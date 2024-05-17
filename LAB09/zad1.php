<DOCTYPE! html>
<html>
<head>
    <link href="zad1.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
    <div id="all">
        <div id="main">
            <h1>Wprowadź nazwę pliku lub katalogu</h1>

            <div id="input">
                <form action="#" method="POST">
                    <input type="text" name="filename" required><br>
                    <input type="submit" value="Wyślij">
                </form>
            </div>

            <?php
                function dir_size($dir_name) {
                    $size = 0;
                    $dn = opendir($dir_name);
                    while(($file = readdir($dn)) !== false) {
                        if($file != "." && $file != "..") {
                            if(is_file($dir_name . "/" . $file))
                                $size += filesize($dir_name . "/" . $file);
                            if(is_dir($dir_name . "/" . $file))
                                $size += dir_size($dir_name . "/" . $file);
                        }
                    }
                    closedir($dn);
                    return $size;
                }

                if(!empty($_POST["filename"])) {
                    echo "<div id='output'>";

                    if(file_exists($_POST["filename"])) {
                        echo "<h2>Wyniki:</h2><br>";

                        if(is_dir($_POST["filename"]) == "dir") {
                            $size = dir_size($_POST["filename"]);
                        }
                        else {
                            $size = filesize($_POST["filename"]);
                        }
                        $bytetype = array("bajtów", "kilobajtów", "megabajtów", "gigabajtów");

                        foreach ($bytetype as $type) {
                            echo "Rozmiar: " . $size . " " . $type . "<br>";
                            $size = $size / 1024;
                        }
                    }
                    else {
                        echo "<p>Plik lub katalog nie istnieje.</p>";
                    }

                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>