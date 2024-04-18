<DOCTYPE! html>
<html>
<body>
    <?php
        $minute = (int) date("i");
        
        $color = "red";
        if($minute <= 20 && $minute < 40)
            $color = "green";
        else if($minute >= 40)
            $color = "blue";

        echo "<div style='background-color:$color; border-radius:5px; height:200px; width:100px;'></div>";
    ?>
</body>
</html>