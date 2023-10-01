<?php
    require ("../function.php");
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location:../login.php");
        exit;
    }
    // mengambil data dalam URL
	$id = $_GET["id"];
    // query data berdasar
    $paket = query ('SELECT * FROM paket_layanan ;');
    $tambahan = query ('SELECT * FROM tambahan ;');
    $customer = query ('SELECT * FROM customer');
    $pembayaran = query ('SELECT * FROM pembayaran ;');
    $transaksi = query ('SELECT * FROM pesanan
        JOIN customer ON (customer.idcustomer = pesanan.customer_idcustomer)
        JOIN paket_layanan ON (paket_layanan.idpaket = pesanan.paket_layanan_idpaket)
        JOIN tambahan ON (tambahan.idtambahan = pesanan.tambahan_idtambahan) ;');
    $jmlpembayaran = 0;
    $jmltransaksi = 0;
    $jmlpaket = 0;
    $jmltambahan = 0;
    foreach($pembayaran as $row) :
        $jmlpembayaran++;
    endforeach;
    foreach($transaksi as $row) :
        $jmltransaksi++;
    endforeach;
    foreach($paket as $row) :
        $jmlpaket++;
    endforeach;
    foreach($tambahan as $row) :
        $jmltambahan++;
    endforeach;
    //cek tombol submit sudah ditekan atau belum
    if (isset($_POST["submit"])) {
        //cek apakah data berhasil ditambahkan atau tidak
        if (tambahtransaksi($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil ditambahkan');
                    document.location.href = '../transaksi.php?id=$id';
                </script>
            ";
        }else {
            echo "
                <script>
                    alert('data gagal ditambahkan');
                    document.location.href = '../transaksi.php?id=$id';
                </script>
            ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .tambah {
            color: white;
            background-color: #3ea845;
            border-radius: 5px;
            border: none;
            padding: 10px 32px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .side-link {
            text-decoration: none;
            color: white;
        }
        .sideicon {
            margin-top: 20px;
            padding: 5px 25px 15px;
        }
        .side-list {
            width: 100%;
            padding: 5px 15px 15px;
        }
        .side-list:hover {
            background: #575fb7;
            transition: background-color 0.3s;
        }
        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            position: fixed;
            height: 100%;
            overflow: auto;
            background: #262A56;
            color: white;
            box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);
        }
        .content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 100vh;
            background-color: #F4F4FF;
        }
        .content h1 {
            margin-top: 10px;
        }
        .cards {
            background-color: #537FE7;
            margin: 10px 25px;
            color: white;
            width: 270px;
            border-radius: 15px;
            box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);
        }
        .contentcard{
            margin-top: 10px;
        }
        .jumlahcard {
            padding: 10px 0 15px;
            margin: 0 15px;
            font-size: 30px;
        }
        .namacard {
            margin: 0 15px;
            padding-bottom: 30px;
            margin-right: 100px;
        }
        .cardicon {
            position: absolute;
            padding-bottom: 30px;
            margin-left: 170px;
        }
        .cardlink {
            background-color: #4569BF;
            text-align: center;
            padding: 5px 0;
            cursor: pointer;
            border-radius: 0 0 15px 15px;
        }
        .cardlink:hover {
            background-color: #9DB1E0;
            transition: background-color 0.3s;
        }
        .kontener {
            margin-top: 30px;
        }
        .column {
            float: left;
            width: 25%;
        }
        .row {
            margin-top: 35px;
        }
        .isi {
            background-color: #ffff;
            box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);
        }
        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }
        .sidebar a {float: left;}
            div.content {margin-left: 0;}
        }
        .tabel {
            border-collapse: collapse;
            width: 95%;
        }
        .tabel td, th {
            border: 3px solid #F4F4FF;
            text-align: left;
            padding: 8px;
        }
        .isitabel:hover {
            background-color: #dddddd;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Admin | Adeabbasy.project</title>
</head>
<body>
    <!-- NavHeader start -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" data-bs-theme="dark" style="box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);">
        <div class="container-fluid">
            <div class="sidebtn" id="sidebtn">
            </div>
            <a class="navbar-brand" href="../index.php?id=<?= $id; ?>" style="text-align: center;">Adeabbasy.project</a>
            <div class="d-flex" role="search">
                <a href="../logout.php"><button class="btn btn-outline-danger">Logout</button></a>
            </div>
        </div>
    </nav>
    <!-- NavHeader ends -->
    <!-- Sidebar Starts -->
    <div class="sidebar">
        <div class="sideicon">
            <i class="fa-regular fa-user fa-2xl"></i>
        </div>
        <div class="sidelist" id="sidelist">
            <a class="side-link" href="../index.php?id=<?= $id ?>"><div class="side-list">
                Dashboard
            </div></a>
            <a class="side-link" href="../paket.php?id=<?= $id; ?>"><div class="side-list">
                Paket Layanan
            </div></a>
            <a class="side-link" href="../transaksi.php?id=<?= $id; ?>"><div class="side-list">
                Transaksi
            </div></a>
            <a class="side-link" href="../customer.php?id=<?= $id; ?>"><div class="side-list">
                Customer
            </div></a>
            <a class="side-link" href="../logout.php"><div class="side-list">
                Logout
            </div></a>
        </div>
    </div>
    <!-- Sidebar Ends -->
    <!-- Content Starts -->
    <div class="content">
        <div class="isi" style="padding: 10px 10px;">
            <h1>Transaksi</h1>
            <h5>Jumlah Transaksi = <?= $jmltransaksi; ?></h5>
        </div>
        <div class="container kontener">
            <div class="row pb-4 isi">
                <div class="column" style="margin: 15px 15px; width: 70%;"><h2>Tambah Transaksi</h2></div>
                <h5 style="margin-left: 20px; width: 50%;">Silahkan Isi Data</h5>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3" style="margin-left: 20px; width: 55%;">
                        <label for="namacust" class="form-label">Nama Pelanggan</label>
                        <select class="form-select" aria-label="Default select example" name="namacust" id="namacust">
                            <?php
                            $cust = 'SELECT * FROM customer';
                            $retvalc = mysqli_query($conn, $cust);
                            while($row = mysqli_fetch_array($retvalc)){
                                echo "<option value='$row[idcustomer]'>$row[nama_cust]</option>";
                            }?>
                        </select>
                    </div>
                    <div class="mb-3" style="margin-left: 20px; width: 55%;">
                        <label for="pkt" class="form-label">Paket</label>
                        <select class="form-select" aria-label="Default select example" name="pkt" id="pkt">
                            <?php
                            $paket = 'SELECT * FROM paket_layanan';
                            $retvalp = mysqli_query($conn, $paket);
                            while($row = mysqli_fetch_array($retvalp)){
                                echo "<option value='$row[idpaket]'>$row[nama_paket]</option>";
                            }?>
                        </select>
                    </div>
                    <div class="mb-3" style="margin-left: 20px; width: 55%;">
                        <label for="tambahan" class="form-label">Tambahan</label>
                        <select class="form-select" aria-label="Default select example" name="tambahan" id="tambahan">
                            <?php
                            $tambahan = 'SELECT * FROM tambahan';
                            $retvalt = mysqli_query($conn, $tambahan);
                            while($row = mysqli_fetch_array($retvalt)){
                                echo "<option value='$row[idtambahan]'>$row[nama_tambahan]</option>";
                            }?>
                        </select>
                    </div>
                    <div class="mb-3" style="margin-left: 20px; width: 55%;">
                        <label for="tgla" class="form-label">Tanggal Acara</label>
                        <input class="form-control" type="date" id="tgla" name="tgla" required>
                    </div>
                    <div class="mb-3" style="margin-left: 20px; width: 55%;">
                        <label for="tglp" class="form-label">Tanggal Pesan</label>
                        <input class="form-control" type="date" id="tglp" name="tglp" required>
                    </div>
                    <div class="mb-3" style="margin-left: 20px; width: 55%;">
                        <label for="tot" class="form-label">Total Harga</label>
                        <input class="form-control" type="number" id="tot" name="tot" required>
                    </div>
                    <div class="mt-3" style="margin-left: 20px; width: 55%;">
                        <Input type="submit" class="btn btn-primary mb-3" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Content Ends -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const totInput = document.getElementById("tot");
            
            totInput.addEventListener("input", function() {
                const value = parseFloat(totInput.value);
                
                if (isNaN(value) || value <= 0) {
                    totInput.setCustomValidity("Total Harga harus berupa angka positif.");
                } else {
                    totInput.setCustomValidity("");
                }
            });
        });
    </script>
</body>
</html>