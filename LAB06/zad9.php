<html>
<body>
    <?php
        $tomoyacollection = array(
            "https://static.wikia.nocookie.net/ensemble-stars/images/2/21/Tomoya_Mashiro_Work_Unit_Outfit_Chibi.png",
            "https://static.wikia.nocookie.net/ensemble-stars/images/f/ff/Tomoya_Mashiro_Work_Parallel_World_Outfit_Chibi.png",
            "https://static.wikia.nocookie.net/ensemble-stars/images/6/6d/Tomoya_Mashiro_Work_New_Start_GO_Outfit_Chibi.png",
            "https://static.wikia.nocookie.net/ensemble-stars/images/c/c6/Tomoya_Mashiro_Work_Flamb%C3%A9%21_Outfit_Chibi.png",
            "https://static.wikia.nocookie.net/ensemble-stars/images/1/1e/Tomoya_Mashiro_Work_High_and_Low_Outfit_Chibi.png",
            "https://static.wikia.nocookie.net/ensemble-stars/images/0/00/Tomoya_Mashiro_Work_Sanctuary_Outfit_Chibi.png",
            "https://static.wikia.nocookie.net/ensemble-stars/images/4/43/Tomoya_Mashiro_Work_Black_Bunny_Outfit_Chibi.png",
            "https://static.wikia.nocookie.net/ensemble-stars/images/b/bc/Tomoya_Mashiro_Work_Bogie_Time_Outfit_Chibi.png",
            "https://static.wikia.nocookie.net/ensemble-stars/images/9/9f/Tomoya_Mashiro_Work_Poppin%27_Party_Outfit_Chibi.png"
        );
        $zdj = [];
        for($i = 0; $i < 3; $i++) {
            do {
                $x = rand(1, 9);
            } while (in_array($x, $zdj));
            $zdj[] = $x;
        }

        foreach($zdj as $x) {
            echo "<img src=" . "$tomoyacollection[$x]" . "alt=" . "tomoya $x". ">";
        }
    ?>
</body>
</html>