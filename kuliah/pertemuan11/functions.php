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
	if(!in_array($gambar, $ektensiGambarValid)) {
		echo "<script>alert('Yang Anda Upload Bukan Gambar!');window.location='tambah.php';</script>";
		return false;
	}
	$sumber = $_FILES['gambar']['tmp_name'];
	move_uploaded_file($sumber, 'img/' . $gambar);

	$query = mysqli_query($conn, "INSERT INTO mahasiswa (nama, nrp, email, jurusan, gambar) VALUES ('$nama', '$nrp', '$email', '$jurusan', '$gambar')") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function hapus($id)
{
	$conn = koneksi();
	$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($result);
	$gambar = $row['gambar'];
	if(file_exists("img/" . $gambar)) {
		unlink("img/" . $gambar);
	}
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function ubah($data) {
	$conn = koneksi();
	$id = $data['id'];
	$nama = htmlspecialchars($data['nama']);
	$nrp = htmlspecialchars($data['nrp']);
	$email = htmlspecialchars($data['email']);
	$jurusan = htmlspecialchars($data['jurusan']);
	$gambarLama = $data['gambarLama'];
	// cek gambar
	// sudo chmod -R 777 /var/www/html/test/uploads, jika terjadi error
	
	if($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = mysqli_query($conn, "UPDATE mahasiswa SET
					nama = '$nama',
					nrp = '$nrp', 
					email = '$email',
					jurusan = '$jurusan',
					gambar = '$gambar' WHERE id = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function upload()
{
	$namaFile = $_FILES['gambar']['name'];
	$error = $_FILES['gambar']['error'];
	$ukuranFile = $_FILES['gambar']['size'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	$gambarLama = $_POST['gambarLama'];

	$ektensiGambarValid = ['jpg','jpeg','png'];
	$ektensiGambar = explode('.', $namaFile);
	$ektensiGambar = strtolower(end($ektensiGambar));

	if(!in_array($ektensiGambar, $ektensiGambarValid)) {
		echo "<script>alert('yang anda upload bukan gambar.')</script>";
		return false;
	} 

	if($ukuranFile > 1000000) {
		echo "<script>alert('gambar yang anda upload terlalu besar.')</script>";
		return false;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ektensiGambar;

	// replace gambar
	
	$path = "img/" . $gambarLama;
	if(file_exists($path)) {
		unlink($path);
	}

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;
}


function cari($keyword)
{
	// $conn = koneksi();
	$query = "SELECT * FROM mahasiswa WHERE 
						nama LIKE '%$keyword%' OR 
						nrp LIKE '%$keyword%' OR 
						email LIKE '%$keyword%' OR 
						jurusan LIKE '%$keyword%'";
	return query($query);
}