<?php 
require_once '../functions.php';
$mahasiswa = cari($_GET['keyword']);
?>
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
