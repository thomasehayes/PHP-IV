<?php 
require_once 'db_connection.php';

echo $connection->getAttribute(PDO::ATTR_CONNECTION_STATUS), PHP_EOL;


 ?>