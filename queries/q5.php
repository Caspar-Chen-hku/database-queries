<?php

// Include the connection information
// Remember to include this line in all answers
include "config.php";

// Connect to database
mysql_connect($host,$username,$password);
mysql_select_db($database) or die("Unable to select database");

// Execute the Query
$query = "SELECT r1.memberID, r1.name, r1.licence, COALESCE( SUM( r2.fare ) , 0 ) AS totalFare
FROM (
SELECT m.memberID, m.name, d.licence
FROM Member m, Driver d
WHERE d.memberID = m.memberID
)r1
LEFT OUTER JOIN (
SELECT v.owner, t.carPlate, t.fare
FROM Vehicle v, Trip t
WHERE v.carPlate = t.carPlate
)r2 ON r1.memberID = r2.owner
GROUP BY r1.memberID;";
$result = mysql_query($query) or die( "Unable to execute query:".mysql_error());

// Display the Result
echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 5</title>";
echo "</head>";
echo "<body  align=center>";

// More code to display result
echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>memberID</th>";
echo "<th>name</th>";
echo "<th>licence</th>";
echo "<th>totalFare</th>";
echo "</tr>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['memberID']."</td>";
	echo "<td>".$row['name']."</td>";
	echo "<td>".$row['licence']."</td>";
	echo "<td>".$row['totalFare']."</td>";
    echo "</tr>";
}

echo "</body>";
echo "</html>";
mysql_close();
?>
