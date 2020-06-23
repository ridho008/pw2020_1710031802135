<?php  
session_start();
require_once 'functions.php';

// cek ingin mengunjungi hapus.php tanpa mengirim id
if(!isset($_GET['id'])) {
	header("Location: index.php");
	exit;
}

if(!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

// if(isset($_POST['login'])) {
// 	$login = login($_POST);
// }

$id = $_GET['id'];

if(hapus($id) > 0) {
	echo "<script>alert('Data Berhasil Dihapus.');window.location='index.php';</script>";
} else {
	echo "<script>alert('Data Gagal Dihapus.')</script>";
}

?>