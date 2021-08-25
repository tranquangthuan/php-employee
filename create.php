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
	$nameError = "";
	$emailError = "";
	$mobileError = "";

	$name = $email = $mobile = "";

	if (! empty ( $_POST )) {
		$name = $_POST ['name'];
		$email = $_POST ['email'];
		$mobile = $_POST ['mobile'];

		// validate input
		$valid = true;
		if (empty ( $name )) {
			$nameError = 'Please enter Name';
			$valid = false;
		}

		if (empty ( $email )) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}

		if (empty ( $mobile )) {
			$mobileError = 'Please enter Mobile Number';
			$valid = false;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect ();
			$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
			$q = $pdo->prepare ( $sql );
			$q->execute ( array (
					$name,
					$email,
					$mobile
			) );
			Database::disconnect ();
			header ( "Location: index.php" );
		}
	}
	?>
	<div class="container">
		<div class="span10 offset1">
			<div class="row">
				<h3>Create a customer</h3>
			</div>
			<form class="form-horizontal" action="create.php" method="post">
				<div
					class="control-group <?php echo !empty($nameError) ? 'error' : '' ; ?>">
					<label class="control-label">Name</label>
					<div class="controls">
						<input name="name" type="text" placeholder="Please input name"
							value="<?php echo !empty($name) ? $name : ''; ?>" /> <span
							style="color: red"><?php echo $nameError;?></span>
					</div>
				</div>

				<div
					class="control-group <?php echo !empty($emailError) ? 'error' : '' ; ?>">
					<label class="control-label">Email</label>
					<div class="controls">
						<input name="email" type="text" placeholder="Please input email"
							value="<?php echo !empty($email) ? $email : ''; ?>" /> <span
							style="color: red"><?php echo $emailError;?></span>
					</div>
				</div>

				<div
					class="control-group <?php echo !empty($mobileError) ? 'error' : '' ; ?>">
					<label class="control-label">Name</label>
					<div class="controls">
						<input name="mobile" type="text" placeholder="Please input mobile"
							value="<?php echo !empty($mobile) ? $mobile : ''; ?>" /> <span
							style="color: red"><?php echo $mobileError; ?></span>
					</div>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a class="btn" href="index.php">Back</a>
				</div>
			</form>
		</div>
	</div>


</body>
</html>