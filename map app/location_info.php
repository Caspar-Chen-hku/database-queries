<?php

require("config.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=mysql_connect ($host, $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

/*************************************************

 Find the source of the trip with tripID = 1
 
 *************************************************/

$query = "SELECT * 
FROM Location
WHERE Location.name
IN (
SELECT source
FROM Trip
WHERE tripID =1
);";

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("type", "source");
}

/*************************************************

 Find the destination of the trip with tripID = 1
 
 *************************************************/

$query2 = "SELECT * 
FROM Location
WHERE Location.name
IN (
SELECT destination
FROM Trip
WHERE tripID =1
);";
$result2 = mysql_query($query2);
if (!$result2) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row2 = @mysql_fetch_assoc($result2)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row2['name']);
  $newnode->setAttribute("address", $row2['address']);
  $newnode->setAttribute("lat", $row2['lat']);
  $newnode->setAttribute("lng", $row2['lng']);
  $newnode->setAttribute("type", "destination");
}

echo $dom->saveXML();

?>