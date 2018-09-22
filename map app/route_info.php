<?php
require("config.php");

// Opens a connection to a MySQL server
$connection=mysql_connect ($host, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

/*************************************************

 Get the lat, lng of the route with tripID = 1. 
 Order the results by ascending order of seq.
 
 *************************************************/
$query = "SELECT lat, lng
FROM Route
WHERE tripID =1
ORDER BY seq ASC; ";

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
$rows = array();
while ($row = @mysql_fetch_assoc($result)){
    $row['lat'] = floatval($row['lat']);
    $row['lng'] = floatval($row['lng']);

    array_push($rows,$row);
}
$route_array = json_encode($rows);
echo $route_array;

?>