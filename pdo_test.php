<?php 
require_once 'db_connection.php';

// This is optional, we just want to show some output to confirm 
// that the connection was successful
echo $connection->getAttribute(PDO::ATTR_CONNECTION_STATUS), PHP_EOL;


 ?>