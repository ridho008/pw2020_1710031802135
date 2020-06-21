<?php

function koneksi()
{
	// koneksi ke DB  & pilih database
return  mysqli_connect("localhost", "root", "", "pw_1710031802135");
}

function query($query) {
	$conn = koneksi();
	$result = mysqli_query($conn, $query); // query di ambil dari parameter

	// jika hasilnya cuma 1 data
	// if(mysqli_num_rows($result) === 1) {
	// 	return mysqli_fetch_assoc($result);
	// }

	$rows = []; //siapkan kotak kosong untuk baju
	while($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row; //setiapkan lopping masukan baju kedalam kotak
	}
	return $rows; //bawa/kembalikan baju bersama kotaknya
}


function tambah($data)
{
	$conn = koneksi();
	$nama = htmlspecialchars($data['nama']);
	$nrp = htmlspecialchars($data['nrp']);
	$email = htmlspecialchars($data['email']);
	$jurusan = htmlspecialchars($data['jurusan']);

	// cek gambar
	// sudo chmod -R 777 /var/www/html/test/uploads, jika terjadi error
	$ektensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ektensi = explode('.', $_FILES['gambar']['name']);
	$gambar = 'mhs' . round(microtime(true)) . '.' . end($ektensi);
	$sumber = $_FILES['gambar']['tmp_name'];
	if(!in_array($gambar, $ektensiGambarValid)) {
		echo "<script>alert('Yang Anda Upload Bukan Gambar!');window.location='tambah.php';</script>";
		return false;
	}
	move_uploaded_file($sumber, 'img/' . $gambar);

	$query = mysqli_query($conn, "INSERT INTO mahasiswa (nama, nrp, email, jurusan, gambar) VALUES ('$nama', '$nrp', '$email', '$jurusan', '$gambar')") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}