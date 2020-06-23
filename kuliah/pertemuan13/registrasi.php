<?php 
require_once 'functions.php';

if(isset($_POST['register'])) {
	if(registrasi($_POST) > 0) {
		echo "<script>alert('User berhasil ditambahkan.');window.location='login.php';</script>";
	} else {
		echo "<script>alert('User gagal ditambahkan.')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrasi</title>
</head>
<body>
	<h3>Formulir Registrasi</h3>
	<form action="" method="post">
		<table>
			<tr>
				<td>
					<label for="username">Username</label>
					<input type="text" name="username" id="username" autofocus="on" autocomplete="off" required>
				</td>
			</tr>
			<tr>
				<td>
					<label for="password1">Password</label>
					<input type="password" name="password1" id="password1" required>
				</td>
			</tr>
			<tr>
				<td>
					<label for="password2">Konfir Password</label>
					<input type="password" name="password2" id="password2" required>
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" name="register">Registrasi</button>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>