<?php 
session_start();
	if(!isset($_SESSION['login'])){
		header("Location:../login.php");
		exit;
	}
require '../function.php';
$id = $_GET["id"];
$idtambahan = $_GET["idtambahan"];
if( hapustbhn($idtambahan) > 0 ) {
	echo "
			<script>
			alert('data berhasil dihapus!');
			document.location.href = '../paket.php?id=$id';
			</script>
		";
	} else {
		echo "
			<script>
			alert('data gagal dihapus!');
			document.location.href = '../paket.php?id=$id';
			</script>
		";
	}

?>