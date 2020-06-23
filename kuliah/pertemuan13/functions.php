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


// function tambah($data)
// {
// 	$conn = koneksi();
// 	$nama = htmlspecialchars($data['nama']);
// 	$nrp = htmlspecialchars($data['nrp']);
// 	$email = htmlspecialchars($data['email']);
// 	$jurusan = htmlspecialchars($data['jurusan']);


// 	// $nrp = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nrp = '$nrp'");
// 	// if($nrp) {
// 	// 	echo "<script>alert('nrp sudah sudah terdaftar');window.location='tambah.php';</script>";
// 	// 	return false;
// 	// }

// 	// $email = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE email = '$email'");
// 	// if($email) {
// 	// 	echo "<script>alert('email sudah sudah terdaftar');window.location='tambah.php';</script>";
// 	// 	return false;
// 	// }

// 	// cek gambar
// 	// sudo chmod -R 777 /var/www/html/test/uploads, jika terjadi error

// 	// cek ukuran gambar
// 	if($_FILES['gambar']['size'] > 1000000) {
// 		echo "<script>alert('ukuran foto terlalu');window.location='tambah.php';</script>";
// 		return false;
// 	}

	

// 	$ektensiGambarValid = ['jpg', 'jpeg', 'png'];
// 	$ektensi = explode('.', $_FILES['gambar']['name']);
// 	$gambar = 'mhs' . round(microtime(true)) . '.' . end($ektensi);
// 	// if(!in_array($gambar, $ektensiGambarValid)) {
// 	// 	echo "<script>alert('Yang Anda Upload Bukan Gambar!');window.location='tambah.php';</script>";
// 	// 	return false;
// 	// }

// 	// cek apakah gambar sudah di upload ?
// 	if($_FILES['gambar']['error'] === 4) {
// 		// echo "<script>alert('Upload gambar dulu!.');window.location='tambah.php';</script>";
// 		return 'nophoto.jpg';
// 	}

// 	$typeFile = $_FILES['gambar']['type'];
// 	// cek valid type gambar
// 	if($typeFile != 'image/jpeg' || $typeFile != 'image/png') {
// 		echo "<script>alert('yang anda upload tidak gambar !!');window.location='tambah.php';</script>";
// 		return false;
// 	}

// 	$sumber = $_FILES['gambar']['tmp_name'];
// 	move_uploaded_file($sumber, 'img/' . $gambar);

// 	$query = mysqli_query($conn, "INSERT INTO mahasiswa (nama, nrp, email, jurusan, gambar) VALUES ('$nama', '$nrp', '$email', '$jurusan', '$gambar')") or die(mysqli_error($conn));

// 	return mysqli_affected_rows($conn);
// }

function tambah($data)
{
	$conn = koneksi();
	$nama = htmlspecialchars($data['nama']);
	$nrp = htmlspecialchars($data['nrp']);
	$email = htmlspecialchars($data['email']);
	$jurusan = htmlspecialchars($data['jurusan']);
	// $gambar = htmlspecialchars($data['gambar']);

	// upload gambar
	$gambar = upload();
	if(!$gambar) {
		return false;
	}

	$query = "INSERT INTO mahasiswa VALUES (null, '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
	mysqli_query($conn, $query) or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}

function upload()
{
	$nama_file = $_FILES['gambar']['name'];
	$tipe_file = $_FILES['gambar']['type'];
	$ukuran_file = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmp_file = $_FILES['gambar']['tmp_name'];

	// ketika tidak ada gambar yang dipilih
	if($error == 4) {
		// echo "<script>alert('Pilih gambar terlebih dahulu.')</script>";
		return 'nophoto.jpg';
	}

	// ketika user memilih bukan gambar / cek ektensi file
	$daftar_gambar = ['jpg','jpeg','png'];
	$ektensi_file = explode('.', $nama_file);
	$ektensi_file = strtolower(end($ektensi_file));
	if(!in_array($ektensi_file, $daftar_gambar)) {
		echo "<script>alert('Yang anda upload bukan gambar.')</script>";
		return false;
	}

	// mengatasi user mengupload file lain, tetapi di ubah menjadi format jpg
	// cek type file
	if($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
		echo "<script>alert('Yang anda pilih bukan gambar!.')</script>";
		return false;
	}

	// cek ukuran file gambar
	if($ukuran_file > 1000000) {
		echo "<script>alert('Ukuran gambar terlalu besar.')</script>";
		return false;
	}

	// lolos pengecekan & siap upload
	// generate file gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ektensi_file;
	move_uploaded_file($tmp_file, 'img/' . $namaFileBaru);
	return $namaFileBaru;
}

function hapus($id)
{
	$conn = koneksi();
	// menghapus gambar di folder img
	$mhs = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id") or die(mysqli_error($conn));
	$row = mysqli_fetch_assoc($mhs);
	$g = $row['gambar'];
	if($g != 'nophoto.jpg') {
		unlink('img/' . $g);
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
	$gambar_lama = htmlspecialchars($data['gambar_lama']);
	
	// cek gambar
	$gambar = upload();
	if(!$gambar) {
		return false;
	}

	// jika tidak ada gambar yang di upload, akan ditimpa dengan gambar default
	if($gambar == 'nophoto.jpg') {
		$gambar = $gambar_lama;
	}
	// sudo chmod -R 777 /var/www/html/test/uploads, jika terjadi error

	$query = mysqli_query($conn, "UPDATE mahasiswa SET
					nama = '$nama',
					nrp = '$nrp', 
					email = '$email',
					jurusan = '$jurusan',
					gambar = '$gambar' WHERE id = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
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

function login($data)
{
	$conn = koneksi();
	$username = htmlspecialchars($data['username']);
	$password = htmlspecialchars($data['password']);

	// cek username
	if($query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'") or die(mysqli_error($conn))) {
		if(mysqli_num_rows($query) === 1) {
			$row = mysqli_fetch_assoc($query);
			// cek password
			if(password_verify($password, $row['password'])) {
				// buat session
				$_SESSION['login'] = true;
				$_SESSION['nama'] = $row['username'];
				echo "<script>alert('Selamat Datang $_SESSION[nama]');window.location='index.php';</script>";
			}
		}	
		
	}
		return [
				'error' => true,
				'pesan' => 'username/password salah'
		];
		
}


function registrasi($data)
{
	$conn = koneksi();
	$username = htmlspecialchars(strtolower($data['username']));
	$password1 = mysqli_real_escape_string($conn, $data['password1']);
	$password2 = mysqli_real_escape_string($conn, $data['password2']);

	// jika username & password kosong
	if(empty($username && $password1 && $password2)) {
		echo "<script>alert('Pastikan anda sudah mengisi inputan!');window.location='registrasi.php';</script>";
		return false;
	}

	// jika username sudah terdaftar
	if(query("SELECT * FROM user WHERE username = '$username'")) {
		echo "<script>alert('Username sudah terdaftar!');window.location='registrasi.php';</script>";
		return false;
	}

	// jika password 1 & password2 tidak sama
	if($password1 !== $password2) {
		echo "<script>alert('Konfirmasi password tidak sesuai');window.location='registrasi.php';</script>";
		return false;
	}

	// batasi jumlah karakter password, jika password < 5
	if(strlen($username) < 5) {
		echo "<script>alert('username terlalu pendek, maksimal 5 digit');window.location='registrasi.php';</script>";
		return false;
	}

	if(strlen($password1) < 5) {
		echo "<script>alert('Password terlalu pendek, maksimal 5 digit');window.location='registrasi.php';</script>";
		return false;
	}

	// jika username & password sudah seduai
	// encripsi
	$passwordBaru = password_hash($password1, PASSWORD_DEFAULT);
	// insert ke table user
	$query = "INSERT INTO user VALUES(null, '$username', '$passwordBaru')";
	mysqli_query($conn, $query) or die(mysqli_error($conn));
	return mysqli_affected_rows($conn);
}