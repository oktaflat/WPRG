<?php
echo "<table>";
	echo "<tr>";
		echo "<td>a</td>";
		echo "<td>b</td>";
		echo "<td>pow(a, b)</td>";
   	echo "</tr>";
    for($x = 1; $x <= 5; $x++){
    $y = $x + 1;
    $z = pow($x, $y);
    echo "<tr>";
    	echo "<td>$x</td>";
    	echo "<td>$y</td>";
    	echo "<td>$z</td>";
    echo "</tr>";
    }
echo "</table>";
?>