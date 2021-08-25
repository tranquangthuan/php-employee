<!DOCTYPE html>
<html lang="en">
<head>
<link href="./resources/css/bootstrap.css" rel="stylesheet">
<script src="./resources/js/jquery-3.6.0.min.js"></script>
<script src="./resources/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h3>PHP CRUD Example</h3>
		</div>
		<div class="row">
			<p>
				<a href="create.php" class="btn btn-primary">Create</a>
			</p>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'DataBase.php';
					include 'Paginator.php';

					$limit = (isset ( $_GET ['limit'] )) ? $_GET ['limit'] : 2;
					$page = (isset ( $_GET ['page'] )) ? $_GET ['page'] : 1;
					$links = (isset ( $_GET ['links'] )) ? $_GET ['links'] : 4;

					$pdo = DataBase::connect ();
					$sql = "select * from customers";
					$paginator = new Paginator ( $pdo, $sql );

					// $result = $pdo->query ( $sql );
					$result = $paginator->getData ( $limit, $page );
					foreach ( $result->data as $row ) {
						echo "<tr>";
						echo "<td>" . $row ["name"] . "</td>";
						echo "<td>" . $row ["email"] . "</td>";
						echo "<td>" . $row ["mobile"] . "</td>";
						echo '<td><a class="btn btn-primary" href="read.php?id=' . $row ['id'] . '">Read</a>';
						echo ' ';
						echo '<a class="btn btn-success" href="update.php?id=' . $row ['id'] . '">Update</a>';
						echo ' ';
						echo '<a class="btn btn-danger" href="delete.php?id=' . $row ['id'] . '">Delete</a></td>';
						echo "</tr>";
					}
					DataBase::disconnect ();
					?>
				</tbody>
			</table>
			<div class="row text-center">
			<?php echo $paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
			</div>
		</div>
	</div>
</body>
</html>