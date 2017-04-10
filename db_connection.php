<?php 

// How we used to connect
// mysql -u vagrant -p -- or -- localhost/ 127.0.0.1
// This is how we connect it with PHP
// DSN - Data Source Name
// 1. Driver. mysql
// 2. Host. 127.0.0.1 or localhost
// 3. Database name. employees
// 4. username: vagrant
// 5. password: vagrant

define('DB_HOST', 'localhost'); // A constant definition
define('DB_NAME', 'employees'); // A constant definition
define('DB_USER', 'vagrant'); // A constant definition
define('DB_PASSWORD', 'vagrant'); // A constant definition
								
try {

	$connection = new PDO(
		'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, 
		DB_USER, 
		DB_PASSWORD
	);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// This is optional, we just want to show some output to confirm 
	// that the connection was successful
	// Will remove because it not neccessary
	// echo $connection->getAttribute(PDO::ATTR_CONNECTION_STATUS), PHP_EOL;

	// Exception
	// comes from exceptional. - Something you cannot control

} catch (PDOException $e) {
    echo  $e->getMessage(), PHP_EOL;
}

?>