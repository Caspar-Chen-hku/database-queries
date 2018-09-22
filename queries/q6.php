<?php

// Include the connection information
// Remember to include this line in all answers
include "config.php";

// Connect to database
mysql_connect($host,$username,$password);
mysql_select_db($database) or die("Unable to select database");

// Execute the Query
$query = "SELECT tripID, passengerID, source, destination, fare
FROM Trip
WHERE passengerID
IN (
SELECT passengerID
FROM Trip
GROUP BY passengerID
HAVING COUNT( passengerID ) >1
)
AND fare NOT 
IN (
SELECT MIN( fare ) 
FROM Trip
GROUP BY passengerID
)
ORDER BY passengerID DESC , tripID DESC; ";
$result = mysql_query($query) or die( "Unable to execute query:".mysql_error());

// Display the Result
echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 6</title>";
echo "</head>";
echo "<body  align=center>";

// More code to display result
echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>tripID</th>";
echo "<th>passengerID</th>";
echo "<th>source</th>";
echo "<th>destination</th>";
echo "<th>fare</th>";
echo "</tr>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['tripID']."</td>";
	echo "<td>".$row['passengerID']."</td>";
	echo "<td>".$row['source']."</td>";
	echo "<td>".$row['destination']."</td>";
	echo "<td>".$row['fare']."</td>";
    echo "</tr>";
}

echo "</body>";
echo "</html>";
mysql_close();
?>
