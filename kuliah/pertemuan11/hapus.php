<?php  
require_once 'functions.php';
if(!isset($_GET['id'])) {
	header("Location: index.php");
	exit;
}
$id = $_GET['id'];

if(hapus($id) > 0) {
	echo "<script>alert('Data Berhasil Dihapus.');window.location='index.php';</script>";
} else {
	echo "<script>alert('Data Gagal Dihapus.')</script>";
}

?>