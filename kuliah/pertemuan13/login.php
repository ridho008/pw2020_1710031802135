<?php 
session_start();
require_once 'functions.php';

if(isset($_SESSION['login'])) {
	header("Location: index.php");
	exit;
}

if(isset($_POST['login'])) {
	$login = login($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<h3>Formulir Login</h3>
	<?php if(isset($login['error'])) : ?>
		<p style="color:red;font-style: italic;"><?= $login['pesan']; ?></p>
	<?php endif; ?>
	<form action="" method="post">
	<table>
		<tr>
			<td>
				<label for="username">Username</label>
				<input type="text" name="username" id="username" required autofocus="on" autocomplete="off">
			</td>
			<td>
				<label for="password">Password</label>
				<input type="password" name="password" id="password" required>
			</td>
		</tr>
		<tr>
			<td>
				<button type="submit" name="login">Login</button>
			</td>
			<td>
				<a href="registrasi.php">Tambah User Baru</a>
			</td>
		</tr>
	</table>
	</form>
</body>
</html>