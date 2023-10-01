<?php 
session_start();
	if(!isset($_SESSION['login'])){
		header("Location:../login.php");
		exit;
	}
require '../function.php';
$id = $_GET["id"];
$idcust = $_GET["idcust"];
if( hapuscust($idcust) > 0 ) {
	echo "
			<script>
			alert('data berhasil dihapus!');
			document.location.href = '../customer.php?id=$id';
			</script>
		";
	} else {
		echo "
			<script>
			alert('data gagal dihapus!');
			document.location.href = '../customer.php?id=$id';
			</script>
		";
	}

?>