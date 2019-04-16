<?php
	require_once 'Validation.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$data = $_POST;

		$rules = [
			"name" => "required",
			"email" => "required|email",
			"password" => "required|minlen:6|maxlen:15",
			"confirm_password" => "confirm:password"
		];

		$errors = Validation::validate($data, $rules);

		
	} else {
		$data = [
			"name" => "",
			"email" => "",
			"password" => "",
			"confirm_password" => ""
		];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sample Validation</title>
	<style>
		.rules {
			color: blue;
		}
		.rules span {
			font-weight: bold;
			color: red;
		}
		.form-group {
			padding: 10px;
		}
		.form-group label {
			width: 100px;
			display: inline-block;
		}
		.alert {
			width: 200px;
			padding: 20px;
			color: white;
		}
		.valid {
			background-color: green;
		}
		.error {
			background-color: pink;
		}
	</style>
</head>
<body>
	<h1>Validation Demo</h1>
	<div class="rules">
		<p>Rules: </p>
		<p><span>Name</span> is required</p>
		<p><span>Email</span> is required and shoud be a valid email</p>
		<p><span>Password</span> is required, minimum character length 6 and maximum is 15</p>
		<p><span>Confirm password</span> should equal to the <span>Password</span></p>
	</div>
	<?php if(isset($errors)) :  ?>
		<div class="alert <?php echo empty($errors) ? "valid" : "error"  ?>">
			<p>Please fix the following!</p>
			<ul>
				<?php foreach ($errors as $error) : ?>
					<li><?php echo $error ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<form action="demo.php" method="POST" novalidate>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" id="name" name="name" value="<?php echo $data['name'] ?>">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" id="email" name="email" value="<?php echo $data['email'] ?>">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" id="password" name="password" value="<?php echo $data['password'] ?>">
		</div>
		<div class="form-group">
			<label for="confirm_password">Confirm Password</label>
			<input type="password" id="confirm_password" name="confirm_password" value="<?php echo $data['confirm_password'] ?>">
		</div>
		<div class="form-group">
			<button type="submit">Submit!</button>
		</div>
	</form>
</body>
</html>