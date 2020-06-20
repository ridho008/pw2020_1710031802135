<?php 
require_once 'functions.php';
$id = $_GET['id'];

$details = query("SELECT * FROM mahasiswa WHERE id = $id");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detail Mahasiswa</title>
</head>
<body>
	<h3>Detail Mahasiswa</h3>
	<a href="latihan3.php">Kembali</a>
	<?php foreach($details as $d) : ?>
	<ul>
		<li><img src="img/<?= $d['gambar']; ?>" width="100"></li>
		<li>Nama : <?= $d['nama']; ?></li>
		<li>NRP : <?= $d['nrp']; ?></li>
		<li>Email : <?= $d['email']; ?></li>
		<li>Jurusan : <?= $d['jurusan']; ?></li>
	</ul>
<?php endforeach; ?>
</body>
</html>