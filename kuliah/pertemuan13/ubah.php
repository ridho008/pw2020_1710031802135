<?php 
require_once 'functions.php';

// jika tidak ada id yang id kirimkan lewat halaman ubah
if(!isset($_GET['id'])) {
	header("Location: index.php");
	exit;
}

// ambil id dari url
$id = $_GET['id'];

// query mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id = $id")[0] or die(mysqli_error($conn));

if(isset($_POST['ubah'])) {
	if(ubah($_POST) > 0) {
		echo "<script>alert('Data Berhasil Diubahkan.');window.location='index.php';</script>";
	} else {
		echo "<script>alert('Data Gagal Diubahkan.')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Data Mahasiswa</title>
</head>
<body>
	<h3>Formulir Ubah Data Mahasiswa</h3>
	<form action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>
					<label for="nama">nama</label>
					<input type="hidden" name="id" value="<?= $m['id']; ?>">
					<input type="text" name="nama" id="nama" autofocus="on" value="<?= $m['nama']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="nrp">nrp</label>
					<input type="number" name="nrp" id="nrp" value="<?= $m['nrp']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="email">email</label>
					<input type="email" name="email" id="email" value="<?= $m['email']; ?>">
				</td>
			</tr>
			<tr>
				<td>
					<label for="jurusan">jurusan</label>
					<select name="jurusan" id="jurusan">
						<option value="Teknik Informatika" <?php if($m['jurusan'] == "Teknik Informatika"){echo "selected";} ?>>Teknik Informatika</option>
						<option value="Teknik Sipil" <?php if($m['jurusan'] == "Teknik Sipil"){echo "selected";} ?>>Teknik Sipil</option>
						<option value="Teknik Lingkungan" <?php if($m['jurusan'] == "Teknik Lingkungan"){echo "selected";} ?>>Teknik Lingkungan</option>
						<option value="Teknik Mesin" <?php if($m['jurusan'] == "Teknik Mesin"){echo "selected";} ?>>Teknik Mesin</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="gambar_lama" value="<?= $m['gambar']; ?>">
					<label for="gambar">Gambar</label>
					<input type="file" name="gambar" id="gambar" class="gambar" onchange="previewImage()">
					<img src="img/<?= $m['gambar']; ?>" width="100" style="display: block;" class="img-priview">
				</td>
			</tr>
			<tr>
				<td>
					<button type="submit" name="ubah">Ubah Data</button>
				</td>
			</tr>
		</table>
	</form>

<script src="js/script.js"></script>
</body>
</html>