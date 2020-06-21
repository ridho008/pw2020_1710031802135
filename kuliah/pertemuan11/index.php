<?php 
require_once 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

// ketika tombol cari diklik
if(isset($_POST['cari'])) {
	$mahasiswa = cari($_POST['keyword']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Daftar Mahasiswa</title>
</head>
<body>
	<a href="tambah.php">Tambah Data Mahasiswa</a>
	<h3>Daftar Mahasiswa</h3>
	<form action="" method="post">
		<input type="text" name="keyword" size="30" placeholder="masukan keyword pencarian" autocomplete="off" autofocus="on">
		<button type="submit" name="cari">Cari</button>
	</form>
	<br>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>#</th>
			<th>Gambar</th>
			<th>Nama</th>
			<th>Aksi</th>
		</tr>
		<?php if(empty($mahasiswa)) : ?>
		<tr>
			<td colspan="4">Data mahasiswa tidak ditemukan!</td>
		</tr>
		<?php endif; ?>
		<?php 
		$no = 1;
		foreach($mahasiswa as $mhs) : ?>
		<tr>
			<td><?= $no++; ?></td>
			<td>
				<img src="img/<?= $mhs['gambar']; ?>" width="100">
			</td>
			<td><?= $mhs['nama']; ?></td>
			<td>
				<a href="detail.php?id=<?= $mhs['id']; ?>">Lihat Details</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
</body>
</html>