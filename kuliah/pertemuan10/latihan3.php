<?php 
require_once 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

// tampung ke variabel mahasiswa

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Daftar Mahasiswa</title>
</head>
<body>
	<h3>Daftar Mahasiswa</h3>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>#</th>
			<th>Gambar</th>
			<th>Nama</th>
			<th>Aksi</th>
		</tr>
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