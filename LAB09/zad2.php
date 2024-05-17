<DOCTYPE! html>
<html>
<head>
    <link href="zad2.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
    <div id="all">
        <div id="main">
            <h1>Licznik odwiedzin witryny</h1>

            <div id="minimain">
                <div id="counter">
                    <p>
                        Odwiedzin:

                        <?php
                            if(isset($_POST["reset"])) {
                                $file = fopen("licznik.txt", 'w');
                                fwrite($file, "0");
                                fclose($file);
                                header("location:zad2.php");
                            }
                            if(!(file_exists("licznik.txt"))) {
                                echo "0";
                                $file = fopen("licznik.txt", 'w+');
                                $counter = 1;
                                fwrite($file, $counter);
                                fclose($file);
                                header("location:zad2.php");
                            }
                            else {
                                $file = fopen("licznik.txt", 'r+');
                                $counter = intval(file_get_contents("licznik.txt"));
                                echo file_get_contents("licznik.txt");
                                $counter++;
                                fwrite($file, $counter);
                                fclose($file);
                            }
                        ?>
                    </p>
                </div>

                <form action="#" method="POST">
                    <input type="submit" name="reset" value="Resetuj licznik">
                </form>
            </div>
        </div>
    </div>
</body>
</html>