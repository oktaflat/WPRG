<?php
	function celsiusToFahrenheit($celsius) {
    	return $celsius * (9 / 5) + 32;
    }
    
    function fahrenheitToCelsius($fahrenheit) {
    	return ($fahrenheit - 32) * 5 / 9;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        th {
            border-bottom: 2px solid black;
        }

        th:nth-child(2), td:nth-child(2) {
            border-right: 1px dashed black;
        }
    </style>
</head>
<body>
    <table>
    	<thead>
    		<tr>
        		<th>Celsius</th>
            	<th>Fahrenheit</th>
            	<th>Fahrenheit</th>
            	<th>Celsius</th>
			</tr>
        </thead>
        <tbody>
        	<?php
            	$celsius = (float) 40;
                $fahrenheit = (float) 120;
            	for($i = 0; $i < 10; $i++) {
                	echo "<tr>";
                    	echo "<td>$celsius</td>";
                    	echo "<td>" . celsiusToFahrenheit($celsius) . "</td>";
                    	echo "<td>$fahrenheit</td>";
                        echo "<td>" . fahrenheitToCelsius($fahrenheit) . "</td>";
                    echo "</tr>";
                    $celsius--;
                    $fahrenheit -= 10;
                }
            ?>
        </tbody>
    </table>
</body>
</html>