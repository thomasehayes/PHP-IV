<?php 
require_once 'db_connection.php';

$clearTable = 'TRUNCATE national_parks';
$connection->exec($clearTable);

$parks = [
    ['name' => 'Acadia', 'location' => 'Maine', 'date_established' => '1919-02-26', 'area_in_acres' => 48995.91],

    ['name' => 'American Samoa', 'location' => 'American Samoa', 'date_established' => '1988-10-31', 'area_in_acres' => 8256.67],

    ['name' => 'Arches', 'location' => 'Utah', 'date_established' => '1990-11-12', 'area_in_acres' => 76678.98],

    ['name' => 'Badlands', 'location' => 'South Dakota', 'date_established' => '1978-11-10', 'area_in_acres' => 242755.94],

    ['name' => 'Big Bend', 'location' => 'Texas', 'date_established' => '1944-06-12', 'area_in_acres' => 801163.21],

    ['name' => 'Biscayne', 'location' => 'Florida', 'date_established' => '1980-06-28', 'area_in_acres' => 172971.11],

    ['name' => 'Black Canyon of the Gunnison', 'location' => 'Colorado', 'date_established' => '1999-10-21', 'area_in_acres' => 30749.75],

    ['name' => 'Bryce Canyon', 'location' => 'Utah', 'date_established' => '1928-02-25', 'area_in_acres' => 35825.08],

    ['name' => 'Canyonlands', 'location' => 'Utah', 'date_established' => '1964-09-12', 'area_in_acres' => 337597.83],

    ['name' => 'Capitol Reef', 'location' => 'Utah', 'date_established' => '1971-12-18', 'area_in_acres' => 241904.26]
];

foreach($parks as $park) {
	$query = "INSERT INTO national_parks(name, location, date_established, area_in_acres) VALUES ('{$park['name']}','{$park['location']}','{$park['date_established']}','{$park['area_in_acres']}')";

	$connection->exec($query);

	echo "Inserted ID: " . $connection->lastInsertId() . PHP_EOL;
}
?>