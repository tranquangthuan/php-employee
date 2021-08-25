<?php
require 'DataBase.php';
$id = $_GET ["id"];
if ($id === NULL) {
	header ( "Location:index.php" );
} else {
	$pdo = DataBase::connect ();
	$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$sql = "select * from customers where id = ? ";
	$stm = $pdo->prepare ( $sql );
	$stm->execute ( array (
			$id
	) );
	$data = $stm->fetch ( PDO::FETCH_ASSOC );
	var_dump ( $data );
	DataBase::disconnect ();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="./resources/css/bootstrap.css" rel="stylesheet">
<script src="./resources/js/jquery-3.6.0.min.js"></script>
<script src="./resources/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<div class="span10 offset1">
			<div class="row">
				<h3>Read a Customer</h3>
			</div>

			<div class="form-horizontal">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Name</label>
					<div class="col-sm-10">
						<label class="checkbox">
                                <?php echo $data['name'];?>
                            </label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<label class="checkbox">
                                <?php echo $data['email'];?>
                            </label>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Mobile</label>
					<div class="col-sm-10">
						<label class="checkbox">
                                <?php echo $data['mobile'];?>
                            </label>
					</div>
				</div>
				<div class="form-actions">
					<a class="btn" href="index.php">Back</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>