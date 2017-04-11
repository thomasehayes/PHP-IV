<?php 

	require __DIR__ . '/db_connection.php';
	require __DIR__ . '/../Input.php';

	$title = "National Parks";

function getLastPage($connection, $limit) {

	$statement = $connection->query("SELECT count(*) FROM national_parks");
	$count = $statement->fetch()[0]; // to get the count
	$lastPage = ceil($count / $limit);

	return $lastPage;
}

function getPaginatedParks($connection, $page, $limit) {
	// offset = (pageNumber - 1) * limit
	$offset = ($page - 1) * $limit;

	$select = "SELECT * FROM national_parks LIMIT $limit OFFSET $offset";
	$statement = $connection->query($select);

	return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function handleOutOfRangeRequest($page, $lastPage) {
	// protect from looking at negative pages, too high pages, and non-numeric pages

	if($page < 1 || !is_numeric($page)) {
		header("location: national_parks.php?page=1");
		die;
	} else if($page > $lastPage) {
		header("location: national_parks.php?page=$lastPage");
		die;
	}

}

function pageController($connection) {

	$data = [];
	$limit = 4;
	$page = Input::get('page', 1);

	$lastPage = getLastPage($connection, $limit);
	handleOutOfRangeRequest($page, $lastPage);

	$data['parks'] = getPaginatedParks($connection, $page, $limit);
	$data['page'] = $page;
	$data['lastPage'] = $lastPage;

	return $data;
}

extract(pageController($connection));

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="national_parks.css">
    <title><?= $title ?></title>
    <!--[if lt IE 9]>
    <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
    </script>
    <script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js">
    </script>
    <![endif]-->
</head>
<body>
	<main class="container">
	<h1 class="col-xs-12">National Parks</h1>
	
	<table class="table table-bordered table-striped">

		<thead>
			<tr>
				<th class="col-xs-3">Name</th>
				<th class="col-xs-3">Location</th>
				<th class="col-xs-3">Date Established</th>
				<th class="col-xs-3">Area in Acres</th>
			</tr>
		</thead>

		<?php foreach($parks as $park): ?>
			<tbody>
				<tr>
					<td class="col-xs-3"><?= $park['name'] ?></td>
					<td class="col-xs-3"><?= $park['location'] ?></td>
					<td class="col-xs-3"><?= $park['date_established'] ?></td>
					<td class="col-xs-3"><?= $park['area_in_acres'] ?></td>
				</tr>
			</tbody>
		<?php endforeach; ?>

	</table>

		<?php if($page > 1): ?>
			<a href="?page=<?= $page - 1 ?>"><span class="glyphicon glyphicon-chevron-left">Previous</span></a>
		<?php endif; ?>

		<?php if($page < $lastPage): ?>	
			<a class="pull-right" href="?page=<?= $page + 1 ?>"><span class="glyphicon glyphicon-chevron-right">Next</span></a>
		<?php endif; ?>

	</main>
</body>
</html>