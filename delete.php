<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css"
	href="./resources/css/bootstrap.css">
<script type="text/javascript" src="./resources/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./resources/js/bootstrap.js"></script>
</head>
<body>
	<?php
	require 'database.php';

	$id = null;
	if (! empty ( $_GET ['id'] )) {
		$id = $_REQUEST ['id'];
		if ($id == NULL) {
			header ( "Location: index.php" );
		}
	}

	if (! empty ( $_POST )) {
		$id = $_POST ['id'];
		$pdo = Database::connect ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = "DELETE FROM customers WHERE id = ?";
		$q = $pdo->prepare ( $sql );
		$q->execute ( array (
				$id
		) );
		Database::disconnect ();
		header ( "Location: index.php" );
	}
	?>
	<div class="container">
		<div class="span10 offset1">

			<div class="row">
				<h3>Delete a Customer</h3>
			</div>

			<form class="form-horizontal" action="delete.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>" />
				<p class="alert alert-error">Are you sure to delete ?</p>
				<div class="form-actions">
					<button type="submit" class="btn btn-danger">Yes</button>
					<a class="btn" href="index.php">No</a>
				</div>
			</form>
		</div>
	</div>
</body>
</html>