<?php 
session_start();
require_once 'functions.php';

// cek ingin mengunjungi hapus.php tanpa mengirim id
if(!isset($_GET['id'])) {
	header("Location: index.php");
	exit;
}

if(isset($_POST['login'])) {
	$login = login($_POST);
}
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
	<a href="index.php">Kembali</a>
	<?php foreach($details as $d) : ?>
	<ul>
		<li><img src="img/<?= $d['gambar']; ?>" width="100"></li>
		<li>Nama : <?= $d['nama']; ?></li>
		<li>NRP : <?= $d['nrp']; ?></li>
		<li>Email : <?= $d['email']; ?></li>
		<li>Jurusan : <?= $d['jurusan']; ?></li>
		<li>
			<a href="ubah.php?id=<?= $d['id']; ?>">Ubah</a>
			<a href="hapus.php?id=<?= $d['id']; ?>" onclick="return confirm('Yakin ?')">Hapus</a>
		</li>
	</ul>
<?php endforeach; ?>
</body>
</html>