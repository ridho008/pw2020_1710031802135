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