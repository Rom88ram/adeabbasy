<?php
    //koneksi database
    $conn = mysqli_connect('localhost','root','','dbadeabbasy');

    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)){ 
            $rows[] = $row;
        }
        return $rows;
    }

	//Registrasi
	function registrasi($data){
		global $conn;
		$namacust = htmlspecialchars($data["namacust"]);
		$alamat = htmlspecialchars($data["alamat"]);
		$nohp = htmlspecialchars($data["nohp"]);
		$email = htmlspecialchars($data["email"]);
		$pass = htmlspecialchars($data['pass']);
		//cek username ada atau belum
		$result = mysqli_query($conn, "SELECT email FROM customer WHERE email = '$email'");
		if(mysqli_fetch_assoc($result)){
			echo "<script>
				alert ('Email sudah terdaftar')
				</script>";
			return false;
		}
		//tambah data
		mysqli_query($conn, "INSERT INTO customer VALUES('', '$namacust', '$alamat', '$nohp', '$email', '$pass')");
		return mysqli_affected_rows($conn);
	}
	// fungsi pemesanan
	function pesan ($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$idcust =  htmlspecialchars($data["idcust"]);
		$pkt = htmlspecialchars($data["pkt"]);
		$tambahan = htmlspecialchars($data["tambahan"]);
		$tbh = query ("SELECT * FROM tambahan WHERE idtambahan = $tambahan ;")[0];
		$tgla = htmlspecialchars($data["tgla"]);
		$tglp = htmlspecialchars($data["tglp"]);
		$tot = htmlspecialchars($data["tot"]);
		$tot = $tot + $tbh['harga_tambahan'];
		//cek username ada atau belum
		$result = mysqli_query($conn, "SELECT tanggal_acara FROM pesanan WHERE tanggal_acara = '$tgla'");
		if(mysqli_fetch_assoc($result)){
			echo "<script>
				alert ('Tanggal pesanan sudah terdaftar')
				</script>";
			return false;
		}
		$bukti = uploadbkt();
		if (!$bukti){
			return false;
		}
		// query insert data
		$query1 = "INSERT INTO pesanan VALUES ('','$pkt','$idcust','$tambahan','$tglp','$tgla','$tot')";
		mysqli_query($conn, $query1);
		$lastInsertedId = mysqli_insert_id($conn);
		$query2 = "INSERT INTO pembayaran VALUES ('$lastInsertedId','$lastInsertedId','$bukti','','Belum Dibayar')";
		mysqli_query($conn, $query2);
		return mysqli_affected_rows($conn);
	}
	// function pesan($data) {
	// 	global $conn;
	// 	// ambil data dari tiap element dalam form
	// 	$idcust =  htmlspecialchars($data["idcust"]);
	// 	$pkt = htmlspecialchars($data["pkt"]);
	// 	$tambahan = $data["tambahan"]; // Perubahan di sini
	// 	$tgla = htmlspecialchars($data["tgla"]);
	// 	$tglp = htmlspecialchars($data["tglp"]);
	// 	$tot = htmlspecialchars($data["tot"]);

	// 	// Menghitung total harga dengan tambahan
	// 	$totalHarga = $tot;
	// 	foreach ($tambahan as $tambahanId) {
	// 		$tbh = query("SELECT harga_tambahan FROM tambahan WHERE idtambahan = $tambahanId ;")[0];
	// 		$totalHarga += $tbh['harga_tambahan'];
	// 	}
	// 	// cek tanggal pesanan sudah terdaftar atau belum
	// 	$result = mysqli_query($conn, "SELECT tanggal_acara FROM pesanan WHERE tanggal_acara = '$tgla'");
	// 	if (mysqli_fetch_assoc($result)) {
	// 		echo "<script>
	// 			alert('Tanggal pesanan sudah terdaftar')
	// 			</script>";
	// 		return false;
	// 	}
	// 	$bukti = uploadbkt();
	// 	if (!$bukti) {
	// 		return false;
	// 	}
	// 	// query insert data
	// 	$query1 = "INSERT INTO pesanan VALUES ('','$pkt','$idcust','$tgla','$tglp','$totalHarga')"; // Perubahan di sini
	// 	mysqli_query($conn, $query1);
	// 	$lastInsertedId = mysqli_insert_id($conn);
		
	// 	// Insert data tambahan ke dalam tabel pesanan_tambahan
	// 	foreach ($tambahan as $tambahanId) {
	// 		$queryTambahan = "INSERT INTO pesanan_tambahan (idpesanan, idtambahan) VALUES ('$lastInsertedId', '$tambahanId')";
	// 		mysqli_query($conn, $queryTambahan);
	// 	}
	// 	$query2 = "INSERT INTO pembayaran VALUES ('$lastInsertedId','$lastInsertedId','$bukti','','Belum Dibayar')";
	// 	mysqli_query($conn, $query2);
	// 	return mysqli_affected_rows($conn);
	// }

    //fungsi tambah
	function tambahpkt($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$namapkt =  htmlspecialchars($data["namapkt"]);
		$hargapkt = htmlspecialchars($data["hargapkt"]);
		$deskripsipkt = htmlspecialchars($data["deskripsipkt"]);
		// upload gambar
		$gambar_paket = upload();
		if (!$gambar_paket){
			return false;
		}
		// query insert data
		$query = "INSERT INTO paket_layanan VALUES ('','$namapkt','$deskripsipkt','$hargapkt','$gambar_paket')";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	function tambahtbhn($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$namatbhn =  htmlspecialchars($data["namatbhn"]);
		$hargatbhn = htmlspecialchars($data["hargatbhn"]);
		$deskripsitbhn = htmlspecialchars($data["deskripsitbhn"]);
		// query insert data
		$query = "INSERT INTO tambahan VALUES ('','$namatbhn','$deskripsitbhn','$hargatbhn')";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	function tambahcust($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$namacust =  htmlspecialchars($data["namacust"]);
		$alamatcust = htmlspecialchars($data["alamatcust"]);
		$hpcust = htmlspecialchars($data["hpcust"]);
		$emailcust = htmlspecialchars($data["emailcust"]);
		$pass = htmlspecialchars($data["pass"]);
		// query insert data
		$query = "INSERT INTO customer VALUES ('','$namacust','$alamatcust','$hpcust','$emailcust','$pass')";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	function tambahtransaksi($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$namacust =  htmlspecialchars($data["namacust"]);
		$pkt = htmlspecialchars($data["pkt"]);
		$tambahan = htmlspecialchars($data["tambahan"]);
		$tgla = htmlspecialchars($data["tgla"]);
		$tglp = htmlspecialchars($data["tglp"]);
		$tot = htmlspecialchars($data["tot"]);
		//cek username ada atau belum
		$result = mysqli_query($conn, "SELECT tanggal_acara FROM pesanan WHERE tanggal_acara = '$tgla'");
		if(mysqli_fetch_assoc($result)){
			echo "<script>
				alert ('Tanggal pesanan sudah terdaftar')
				</script>";
			return false;
		}
		// query insert data
		$query1 = "INSERT INTO pesanan VALUES ('','$pkt','$namacust','$tambahan','$tglp','$tgla','$tot')";
		mysqli_query($conn, $query1);
		$lastInsertedId = mysqli_insert_id($conn);
		$query2 = "INSERT INTO pembayaran VALUES ('$lastInsertedId','$lastInsertedId','none','','Belum Dibayar')";
		mysqli_query($conn, $query2);
		return mysqli_affected_rows($conn);
	}

	//fungsi upload
    function upload() {
		$namaFile = $_FILES["gambar"]["name"];
		$ukuranFile = $_FILES["gambar"]["size"];
		$error = $_FILES["gambar"]["error"];
		$tmpName = $_FILES["gambar"]["tmp_name"];
		// cek gambar sudah diuplod
		if( $error === 4) {
			echo "
				<script>
				alert('gambar belum diupload');
				</script>
			";
			return false;
		}
		// cek apakah benar ekstensi gambar yang diupload
		$ekstensiGambarValid = ['jpg','jpeg','png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensi = strtolower(end($ekstensiGambar));
		if( !in_array($ekstensi, $ekstensiGambarValid)){
			echo "
				<script>
				alert('ekstensi gambar yang diperbolehkan adalah jpeg, jpg, png');
				</script>
			";
			return false;
		}
		// cek jika size melebihi yang diperbolehkan
		if($ukuranFile > 500000) {
			echo "
				<script>
				alert('gambar melebihi ukuran yang diperbolehkan');
				</script>
			";
			return false;
		}
		// lolos pengecekan, file dimasukkan ke dalam database
		// buat nama file menjadi unik
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensi;
		move_uploaded_file($tmpName, '../../assets/' . $namaFileBaru );
		return $namaFileBaru;
	}
	function uploadbyr() {
		$namaFile = $_FILES["gambar"]["name"];
		$ukuranFile = $_FILES["gambar"]["size"];
		$error = $_FILES["gambar"]["error"];
		$tmpName = $_FILES["gambar"]["tmp_name"];
		// cek gambar sudah diuplod
		if( $error === 4) {
			echo "
				<script>
				alert('gambar belum diupload');
				</script>
			";
			return false;
		}
		// cek apakah benar ekstensi gambar yang diupload
		$ekstensiGambarValid = ['jpg','jpeg','png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensi = strtolower(end($ekstensiGambar));
		if( !in_array($ekstensi, $ekstensiGambarValid)){
			echo "
				<script>
				alert('ekstensi gambar yang diperbolehkan adalah jpeg, jpg, png');
				</script>
			";
			return false;
		}
		// cek jika size melebihi yang diperbolehkan
		if($ukuranFile > 500000) {
			echo "
				<script>
				alert('gambar melebihi ukuran yang diperbolehkan');
				</script>
			";
			return false;
		}
		// lolos pengecekan, file dimasukkan ke dalam database
		// buat nama file menjadi unik
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensi;
		move_uploaded_file($tmpName, '../../assets/pembayaran/' . $namaFileBaru );
		return $namaFileBaru;
	}
	function uploadbkt() {
		$namaFile = $_FILES["gambar"]["name"];
		$ukuranFile = $_FILES["gambar"]["size"];
		$error = $_FILES["gambar"]["error"];
		$tmpName = $_FILES["gambar"]["tmp_name"];
		// cek gambar sudah diuplod
		if( $error === 4) {
			echo "
				<script>
				alert('gambar belum diupload');
				</script>
			";
			return false;
		}
		// cek apakah benar ekstensi gambar yang diupload
		$ekstensiGambarValid = ['jpg','jpeg','png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensi = strtolower(end($ekstensiGambar));
		if( !in_array($ekstensi, $ekstensiGambarValid)){
			echo "
				<script>
				alert('ekstensi gambar yang diperbolehkan adalah jpeg, jpg, png');
				</script>
			";
			return false;
		}
		// cek jika size melebihi yang diperbolehkan
		if($ukuranFile > 500000) {
			echo "
				<script>
				alert('gambar melebihi ukuran yang diperbolehkan');
				</script>
			";
			return false;
		}
		// lolos pengecekan, file dimasukkan ke dalam database
		// buat nama file menjadi unik
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensi;
		move_uploaded_file($tmpName, 'assets/pembayaran/' . $namaFileBaru );
		return $namaFileBaru;
	}

	//fungsi edit
	function editpkt($data) {
		global $conn;
		// ambil data dari tiap element dalam form
		$idpaket = ($data["idpaket"]);
		$namapkt =  htmlspecialchars($data["namapkt"]);
		$hargapkt = htmlspecialchars($data["hargapkt"]);
		$deskripsipkt = htmlspecialchars($data["deskripsipkt"]);
		$gambarLama = htmlspecialchars($data["gambarLama"]);
		// cek user ganti gambar atau tidak
		if($_FILES['gambar']['error'] === 4 ) {
			$gambar = $gambarLama;
		} else {
			$gambar = upload();
		}
		// query update data
		$query = "UPDATE paket_layanan SET nama_paket ='$namapkt', deskripsi_paket = '$deskripsipkt', harga_paket = '$hargapkt', gambar_paket ='$gambar' WHERE idpaket = $idpaket";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	function edittbhn($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$idtambahan = ($data["idtambahan"]);
		$namatbhn =  htmlspecialchars($data["namatbhn"]);
		$hargatbhn = htmlspecialchars($data["hargatbhn"]);
		$deskripsitbhn = htmlspecialchars($data["deskripsitbhn"]);
		// query update data
		$query = "UPDATE tambahan SET nama_tambahan = '$namatbhn', deskripsi_tambahan = '$deskripsitbhn', harga_tambahan = '$hargatbhn' WHERE idtambahan = $idtambahan";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	function editcust($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$idcust = ($data["idcust"]);
		$namacust =  htmlspecialchars($data["namacust"]);
		$alamatcust = htmlspecialchars($data["alamatcust"]);
		$hpcust = htmlspecialchars($data["hpcust"]);
		$emailcust = htmlspecialchars($data["emailcust"]);
		// query update data
		$query = "UPDATE customer SET nama_cust = '$namacust', alamat_cust = '$alamatcust' , no_hp = '$hpcust' , email = '$emailcust' WHERE idcustomer = $idcust";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	function edittransaksi($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$idpesanan = ($data["idpesanan"]);
		$cust =  ($data["cust"]);
		$pkt = ($data["pkt"]);
		$tambahan = ($data["tambahan"]);
		$tgla = ($data["tgla"]);
		$tglp = ($data["tglp"]);
		$tot = htmlspecialchars($data["tot"]);
		// query update data
		$query = "UPDATE pesanan SET paket_layanan_idpaket = '$pkt', customer_idcustomer = '$cust', tambahan_idtambahan = '$tambahan', tanggal_pesanan = '$tglp', tanggal_acara = '$tgla', total_harga = '$tot' WHERE idpesanan = $idpesanan";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	function editbyr($data){
		global $conn;
		// ambil data dari tiap element dalam form
		$idbyr = ($data["idbyr"]);
		$tglk =  htmlspecialchars($data["tglk"]);
		$status = htmlspecialchars($data["status"]);
		$gambarLama = htmlspecialchars($data["gambarLama"]);
		// cek user ganti gambar atau tidak
		if($_FILES['gambar']['error'] === 4 ) {
			$gambar = $gambarLama;
		} else {
			$gambar = uploadbyr();
		}
		// query update data
		$query = "UPDATE pembayaran SET bukti_bayar ='$gambar', tanggal_konfirmasi ='$tglk', status_bayar ='$status' WHERE idpembayaran = $idbyr";
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	//fungsi hapus
	function hapuspkt($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM paket_layanan WHERE idpaket = $id");
		return mysqli_affected_rows($conn);
	}
	function hapustbhn($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM tambahan WHERE idtambahan = $id");
		return mysqli_affected_rows($conn);
	}
	function hapuscust($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM customer WHERE idcustomer = $id");
		return mysqli_affected_rows($conn);
	}
	function hapuspesanan($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM pesanan WHERE idpesanan = $id");
		return mysqli_affected_rows($conn);
	}
?>