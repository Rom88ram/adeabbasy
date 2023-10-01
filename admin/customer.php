<?php
    require ("function.php");
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location:login.php");
        exit;
    }
    // mengambil data dalam URL
	$id = $_GET["id"];
    // query data berdasar
    $customer = query ('SELECT * FROM customer ;');
    $jmlcustomer = 0;
    foreach($customer as $row) :
        $jmlcustomer++;
    endforeach;
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
        .tambah:hover {
            background-color: #57cb5f;
            transition: background-color 0.3s;
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
            width: 90%;
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
            <a class="navbar-brand" href="./" style="text-align: center;">Adeabbasy.project</a>
            <div class="d-flex" role="search">
                <a href="logout.php"><button class="btn btn-outline-danger">Logout</button></a>
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
            <a class="side-link" href="index.php?id=<?= $id ?>"><div class="side-list">
                Dashboard
            </div></a>
            <a class="side-link" href="paket.php?id=<?= $id; ?>"><div class="side-list">
                Paket Layanan
            </div></a>
            <a class="side-link" href="transaksi.php?id=<?= $id; ?>"><div class="side-list">
                Transaksi
            </div></a>
            <a class="side-link" href="#"><div class="side-list">
                Customer
            </div></a>
            <a class="side-link" href="logout.php"><div class="side-list">
                Logout
            </div></a>
        </div>
    </div>
    <!-- Sidebar Ends -->
    <!-- Content Starts -->
    <div class="content">
        <div class="isi" style="padding: 10px 10px;">
            <h1>Pelanggan</h1>
            <h5>Jumlah Pelanggan = <?= $jmlcustomer; ?></h5>
        </div>
        <div class="container kontener">
            <div class="row isi">
                <div class="column" style="margin: 15px 15px;"><h2>Customer</h2></div>
                <a href="./crud/tambahcustomer.php?id=<?= $id ?>" style="padding: 0 30px;"><button class="tambah">Tambah data</button></a>
                <table class="tabel" style="margin: 30px 30px;">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat Pelanggan</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach($customer as $row) :
                    ?>
                    <tr class="isitabel">
                        <td><?= $i; ?>.</td>
                        <td><?= $row["nama_cust"]; ?></td>
                        <td><?= $row["alamat_cust"]; ?></td>
                        <td><?= $row["no_hp"]; ?></td>
                        <td><?= $row["email"]; ?></td>
                        <td><a href="crud/editcust.php?id=<?= $id ?>&idcust=<?= $row["idcustomer"]; ?>">Edit</a> | <a href="crud/hapuscust.php?id=<?= $id ?>&idcust=<?= $row["idcustomer"]; ?>" onclick="return confirm('apakah anda yakin ingin menghapus?');">Hapus</a></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </table>
                <a href="cetakcust.php" style="padding: 0 30px;" target="blank_"><button class="tambah">Cetak Data</button></a></br></br></br>
            </div>
        </div>
    </div>
    <!-- Content Ends -->
</body>
</html>