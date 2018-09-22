<?php

// Include the connection information
// Remember to include this line in all answers
include "config.php";

// Connect to database
mysql_connect($host,$username,$password);
mysql_select_db($database) or die("Unable to select database");

// Step 1.3: More codes here to display the interface in browser.
echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Question 8a</title>";
echo "<link rel='stylesheet' type='text/css' href='style.css'>";
echo "</head>";
echo "<body>";
echo "<div id='header' >Choose a driver</div>";

echo "<form action='q8b.php' method='GET'>";

// Step 2.2 Create a dropdown menu here.
echo "<select name='driverID'>";
// Step 2.3. Add in options in the drop down menu here

// Prepare the database query
$queryB = "SELECT d.memberID, m.name FROM Driver d, Member m WHERE d.memberID=m.memberID;";
//  Execute the query
$resultB = mysql_query($queryB) or die( "Unable to execute query:".mysql_error());

// Each selected tuple becomes an option in the dropdown menu.
while($rowB = mysql_fetch_array($resultB, MYSQL_ASSOC))
{
    echo "<option value='".$rowB['memberID']."'>";
    echo $rowB['name'];
    echo "</option>";
}

echo "</select>";
echo "<input type='submit'>";

echo "</form>";

echo "</body>";
echo "</html>";

// Last step. Close the MySQL database connection
mysql_close();

?>