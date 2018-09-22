<?php

include "config.php";
// Connect to database server
mysql_connect($host,$username,$password);

// Select the database we work on
mysql_select_db($database) or die( "Unable to select database");

if (isset($_GET['driverID'])){
    $query = "SELECT m.name, t.startDate, t.startTime, t.passengerID
FROM Member m, Passenger p, Trip t, Vehicle v, Driver d
WHERE d.memberID = v.owner
AND v.carPlate = t.carPlate
AND t.passengerID = p.memberID
AND p.memberID = m.memberID
AND d.memberID =".$_GET['driverID']." ;";
}else{
   $query = "SELECT m.name, t.startDate, t.startTime, t.passengerID
FROM Member m, Passenger p, Trip t, Vehicle v, Driver d
WHERE d.memberID = v.owner
AND v.carPlate = t.carPlate
AND t.passengerID = p.memberID
AND p.memberID = m.memberID;";
}

$result = mysql_query($query) or die( "Unable to execute query:".mysql_error());

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 8b</title>";
echo "<link rel='stylesheet' type='text/css' href='style.css'>";
echo "</head>";
echo "<body>";
echo "<div id='header' >Choose a passenger that the driver has served</div>";
// More code to display result
echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>name</th>";
echo "<th>startDate</th>";
echo "<th>startTime</th>";
echo "</tr>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo "<tr>";
	echo "<td><a href='q8c.php?driver=".$_GET['driverID']."&passenger=".$row['passengerID']."'>".$row['name']."</a></td>";
    echo "<td>".$row['startDate']."</td>";
	echo "<td>".$row['startTime']."</td>";
    echo "</tr>";
}

echo "</body>";
echo "</html>";
mysql_close();
?>