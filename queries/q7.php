<?php

// Include the connection information
// Remember to include this line in all answers
include "config.php";

// Connect to database
mysql_connect($host,$username,$password);
mysql_select_db($database) or die("Unable to select database");

// Execute the Query
$query = "SELECT m.referrer, m.memberID, m.name, SUM( t.fare ) AS totalFare
FROM Member m, Passenger p, Trip t
WHERE m.referrer IS NOT NULL 
AND m.memberID = p.memberID
AND p.memberID = t.passengerID
GROUP BY m.memberID
HAVING SUM( t.fare ) 
IN (
SELECT MAX( r.totalFare ) 
FROM (
SELECT m.referrer, m.memberID, m.name, SUM( t.fare ) AS totalFare
FROM Member m, Passenger p, Trip t
WHERE m.referrer IS NOT NULL 
AND m.memberID = p.memberID
AND p.memberID = t.passengerID
GROUP BY m.memberID
)r
GROUP BY r.referrer
);";

$result = mysql_query($query) or die( "Unable to execute query:".mysql_error());

// Display the Result
echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 7</title>";
echo "</head>";
echo "<body  align=center>";

// More code to display result
echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>referrerID</th>";
echo "<th>refereeID</th>";
echo "<th>refereeName</th>";
echo "<th>totalFare</th>";
echo "</tr>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['referrer']."</td>";
	echo "<td>".$row['memberID']."</td>";
	echo "<td>".$row['name']."</td>";
	echo "<td>".$row['totalFare']."</td>";
    echo "</tr>";
}

echo "</body>";
echo "</html>";
mysql_close();
?>