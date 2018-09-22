<?php

// Include the connection information
// Remember to include this line in all answers
include "config.php";

// Connect to database
mysql_connect($host,$username,$password);
mysql_select_db($database) or die("Unable to select database");

// Execute the Query
$query = "SELECT m.name, p.creditCardNO FROM Passenger p, Member m WHERE p.memberID = m.memberID AND p.creditCardNO LIKE  '4384%';";
$result = mysql_query($query) or die( "Unable to execute query:".mysql_error());

// Display the Result
echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 1</title>";
echo "</head>";
echo "<body  align=center>";

/**********************************
* Please put your name below      *
* Required for this question only *
***********************************/
echo "Author: Chen Cheng<br>";

// More code to display result
echo "<table border=1 width=600 align='center'>";
echo "<tr>";
echo "<th>name</th>";
echo "<th>creditCardNO</th>";
echo "</tr>";

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['creditCardNO']."</td>";
    echo "</tr>";
}

echo "</body>";
echo "</html>";
mysql_close();
?>
