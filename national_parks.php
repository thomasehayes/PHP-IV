<?php 

	require_once 'db_connection.php';

	$title = "National Parks";

	$offset = 4 * $_GET['page'] - 4;
	
	//select all from parks
	$select = "SELECT * FROM national_parks LIMIT 4 OFFSET {$offset}";

	$statement = $connection->query($select);

	$parks = $statement->fetchAll(PDO::FETCH_ASSOC);

	$sqlTotalParks = "SELECT count(*) FROM national_parks";

	$countStatement = $connection->query($sqlTotalParks);

	$totalParks = $countStatement->fetchColumn();

	$numberOfPages = ceil($totalParks/4);

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
	<h1 class="col-xs-12">National Parks</h1>
	
	<table class="col-xs-10 col-xs-offset-2">
		<tr>
			<th class="col-xs-3">Name</th>
			<th class="col-xs-3">Location</th>
			<th class="col-xs-3">Date Established</th>
			<th class="col-xs-3">Area in Acres</th>
		</tr>
		<?php foreach($parks as $park): ?>
			<tr>
				<td class="col-xs-3"><?= $park['name'] ?></td>
				<td class="col-xs-3"><?= $park['location'] ?></td>
				<td class="col-xs-3"><?= $park['date_established'] ?></td>
				<td class="col-xs-3"><?= $park['area_in_acres'] ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<div class="col-xs-12 pagination-bar">
		<ul class="pagination">
			<?php foreach(range(1, $numberOfPages) as $pageNumber):?>
				<li> 
					<a href="national_parks.php?page=<?=$pageNumber?>">
					<?=$pageNumber?></a>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
</body>
</html>