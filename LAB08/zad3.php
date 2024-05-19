<DOCTYPE! html>
<html>
<head>
    <link href="zad3.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>
<body>
    <div id="all">
        <div id="main">
            <h1>Analyser and Transformer of Text with Regex in PHP</h1>

            <form action="#" method="GET">
                <label for="string">Enter text:</label><br>
                <input type="text" id="string" name="string" required><br>

                <label for="pattern">Enter Regex Pattern:</label><br>
                <input type="text" id="pattern" name="pattern" required><br>

                <select name="operation">
                    <option value="matchAll">Match count</option>
                    <option value="matchPos">Match position</option>
                    <option value="replace">Replace</option>
                    <option value="validate">Validate</option>
                </select><br>

                <input type="submit" value="Execute">
            </form>

            <?php
                if(isset($_GET["string"])) {
                    echo "<div class='result'><h3>Result:</h3>";

                    $string = $_GET["string"];
                    $pattern = "/" . $_GET["pattern"] . "/i";

                    switch($_GET["operation"]) {
                        case "matchAll":
                            echo "<p>Number of matches found: " . preg_match_all($pattern, $string) . "</p>";
                            break;
                        case "matchPos":
                            echo "<p>Match found on position: " . strpos($string, $pattern) . "</p>";
                            break;
                        case "replace":
                            echo "<p>Text after replacement: " . preg_replace($pattern, 'YIPPEE', $string) . "</p>";
                            break;
                        case "validate":
                            echo "<p>";
                            if(preg_match($pattern, $string))
                                echo "Pattern matches the text.";
                            else
                                echo "Pattern doesn't match the text.";
                            echo "</p>";
                            break;
                    }

                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>