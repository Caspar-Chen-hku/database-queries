<?php

// Include the connection information
// Remember to include this line in all answers
include "config.php";

// Connect to database
mysql_connect($host,$username,$password);
mysql_select_db($database) or die("Unable to select database");

// Execute the Query
$query = "SELECT t.source AS locations
FROM Trip t, Vehicle v, Driver d
WHERE t.carPlate = v.carPlate
AND v.owner = d.memberID
AND d.memberID =3
UNION 
SELECT t.destination AS locations
FROM Trip t, Vehicle v, Driver d
WHERE t.carPlate = v.carPlate
AND v.owner = d.memberID
AND d.memberID =3
ORDER BY locations;";
$result = mysql_query($query) or die( "Unable to execute query:".mysql_error());

// Display the Result
echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 4</title>";
echo "</head>";
echo "<body  align=center>";

// More code to display result
echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>locations</th>";
echo "</tr>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['locations']."</td>";
    echo "</tr>";
}

echo "</body>";
echo "</html>";
mysql_close();
?>
