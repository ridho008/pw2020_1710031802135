<?php 
session_start();
require_once 'functions.php';

if(!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

if(isset($_POST['tambah'])) {
	if(tambah($_POST) > 0) {
		echo "<script>alert('Data Berhasil Ditambahkan.');window.location='index.php';</script>";
	} else {
		echo "<script>alert('Data Gagal Ditambahkan.')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Data Mahasiswa</title>
</head>
<body>
	<h3>Formulir Tambah Data Mahasiswa</h3>
	<form action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>
					<label for="nama">nama</label>
					<input type="text" name="nama" id="nama" autofocus="on">
				</td>
			</tr>
			<tr>
				<td>
					<label for="nrp">nrp</label>
					<input type="number" name="nrp" id="nrp">
				</td>
			</tr>
			<tr>
				<td>
					<label for="email">email</label>
					<input type="email" name="email" id="email">
				</td>
			</tr>
			<tr>
				<td>
					<label for="jurusan">jurusan</label>
					<select name="jurusan" id="jurusan">
						<option value="">-- Jurusan --</option>
						<option value="Teknik Informatika">Teknik Informatika</option>
						<option value="Teknik Sipil">Teknik Sipil</option>
						<option value="Teknik Lingkungan">Teknik Lingkungan</option>
						<option value="Teknik Mesin">Teknik Mesin</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label for="gambar">Gambar</label>
					<input type="file" name="gambar" id="gambar">
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" name="tambah">Tambah Data</button>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>