<?php

include "config.php";
// Connect to database server
mysql_connect($host,$username,$password);

// Select the database we work on
mysql_select_db($database) or die( "Unable to select database");

if (isset($_GET['driver'])&&isset($_GET['passenger'])){
    $query = "SELECT m.name, t.startDate, t.startTime, t.source, t.destination, t.fare
FROM Driver d, Vehicle v, Trip t, Member m
WHERE d.memberID = v.owner
AND v.carPlate = t.carPlate
AND t.passengerID = m.memberID
AND d.memberID =".$_GET['driver'].
" AND t.passengerID =".$_GET['passenger'].";";
}else{
   $query = "SELECT m.name, t.startDate, t.startTime, t.source, t.destination, t.fare
FROM Driver d, Vehicle v, Trip t, Member m
WHERE d.memberID = v.owner
AND v.carPlate = t.carPlate
AND t.passengerID = m.memberID;";
}

$result = mysql_query($query) or die( "Unable to execute query:".mysql_error());

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 8c</title>";
echo "<link rel='stylesheet' type='text/css' href='style.css'>";
echo "</head>";
echo "<body>";
echo "<div id='header' >Trip information</div>";
// More code to display result
echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>Passenger name</th>";
echo "<th>startDate</th>";
echo "<th>startTime</th>";
echo "<th>source</th>";
echo "<th>destination</th>";
echo "<th>fare</th>";
echo "</tr>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo "<tr>";
	echo "<td>".$row['name']."</td>";
    echo "<td>".$row['startDate']."</td>";
	echo "<td>".$row['startTime']."</td>";
	echo "<td>".$row['source']."</td>";
	echo "<td>".$row['destination']."</td>";
	echo "<td>".$row['fare']."</td>";
    echo "</tr>";
}

echo "</body>";
echo "</html>";
mysql_close();
?>