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
    $pembayaran = query ("SELECT * FROM pembayaran;");
    $transaksi = query('SELECT * FROM pesanan
        JOIN customer ON (customer.idcustomer = pesanan.customer_idcustomer)
        JOIN paket_layanan ON (paket_layanan.idpaket = pesanan.paket_layanan_idpaket)
        JOIN tambahan ON (tambahan.idtambahan = pesanan.tambahan_idtambahan)
        ORDER BY pesanan.tanggal_acara;');
    $jmltransaksi = count($transaksi);
    // Periksa apakah formulir dikirimkan
    if (isset($_POST['submit'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Kueri data dengan filter tanggal
        $transaksi = query("
            SELECT * FROM pesanan
            JOIN customer ON (customer.idcustomer = pesanan.customer_idcustomer)
            JOIN paket_layanan ON (paket_layanan.idpaket = pesanan.paket_layanan_idpaket)
            JOIN tambahan ON (tambahan.idtambahan = pesanan.tambahan_idtambahan)
            WHERE pesanan.tanggal_acara BETWEEN '$start_date' AND '$end_date
            ORDER BY pesanan.tanggal_acara;'
        ");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Update Bootstrap Version -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Add Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap">
    <!-- Add Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4f4ff;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000; /* Menentukan kedalaman tumpukan elemen */
        }
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
            margin-top: 50px;
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
            width: 1400px;
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
        .urut:hover {
            cursor: pointer;
        }
        .isitabel:hover {
            background-color: #dddddd;
        }
    </style>
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
            <a class="side-link" href="#"><div class="side-list">
                Transaksi
            </div></a>
            <a class="side-link" href="customer.php?id=<?= $id; ?>"><div class="side-list">
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
            <h1>Transaksi</h1>
            <h5>Jumlah Transaksi = <?= $jmltransaksi; ?></h5>
        </div>
        <div class="container kontener">
            <div class="row isi">
                <div class="column" style="margin: 15px 15px; width: 90%;"><h2>Transaksi</h2></div>
                <div class="column" style="margin: 15px 15px; width: 90%; display: flex;">
                    <a href="./crud/tambahtransaksi.php?id=<?= $id ?>" style="padding: 0 30px;"><button class="tambah">Tambah data</button></a>
                    <div style="width: 80%; display: flex; justify-content: right;">
                        <form name="filtertgl" method="POST" enctype="multipart/form-data">
                            <div class="input-group">
                                <input required class="form-control" type="date" name="start_date" id="start_date">&nbsp;&nbsp;&nbsp;
                                <input required class="form-control" type="date" name="end_date" id="end_date">&nbsp;&nbsp;&nbsp;
                                <input class="tambah" name="submit" style="border-radius: 5px;" type="submit" value="Filter Tanggal">
                            </div>
                        </form>
                    </div>
                </div>
                <table id="transaksiTable" class="tabel" style="margin: 30px 30px;">
                    <tr>
                        <th>No <i class="fa fa-sort urut" onclick="sortTable(0)"></i></th>
                        <th>Id Pesanan <i class="fa fa-sort urut" onclick="sortTable(1)"></i></th>
                        <th>Pelanggan <i class="fa fa-sort urut" onclick="sortTable(2)"></i></th>
                        <th>Pesanan <i class="fa fa-sort urut" onclick="sortTable(3)"></i></th>
                        <th>Tambahan</th>
                        <th>Tanggal Acara <i class="fa fa-sort urut" onclick="sortTabletgl(5)"></i></th>
                        <th>Tanggal Pesan <i class="fa fa-sort urut" onclick="sortTabletgl(6)"></i></th>
                        <th>Total Harga <i class="fa fa-sort urut" onclick="sortTable(7)"></i></th>
                        <th>Bukti Pembayaran</th>
                        <th>Tanggal Konfirmasi <i class="fa fa-sort urut" onclick="sortTable(9)"></i></th>
                        <th>Status Bayar <i class="fa fa-sort urut" onclick="sortTable(10)"></i></th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach($transaksi as $row) :
                        $pembayaranRow = array_filter($pembayaran, function($item) use ($row) {
                            return $item['pesanan_idpesanan'] == $row['idpesanan'];
                        });

                        $pembayaranData = reset($pembayaranRow);
                    ?>
                    <tr class="isitabel">
                        <td><?= $i; ?>.</td>
                        <td><?= $row["idpesanan"]; ?></td>
                        <td><?= $row["nama_cust"]; ?></td>
                        <td><?= $row["nama_paket"]; ?></td>
                        <td><?= $row["nama_tambahan"]; ?></td>
                        <td><?= date('d F Y', strtotime($row["tanggal_acara"])); ?></td>
                        <td><?= date('d F Y', strtotime($row["tanggal_pesanan"])); ?></td>
                        <td>Rp. <?= number_format($row["total_harga"],0,',','.'); ?>,-</td>
                        <td>
                            <?php
                            if ($pembayaranData["bukti_bayar"] == "none") {
                                echo "Belum Diupload";
                            } else {
                                $xrow = $pembayaranData["bukti_bayar"];
                                echo "<img src='../assets/pembayaran/$xrow' alt='Error' style='height: 100px; width: 100px;'>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($pembayaranData["status_bayar"] == "Sudah Dibayar") {
                                echo date('d F Y', strtotime($pembayaranData["tanggal_konfirmasi"]));
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td 
                        <?php 
                        if ($pembayaranData["status_bayar"] == "Sudah Dibayar") {
                            echo "style='color: green;'";
                        } else {
                            echo "style='color: red;'";
                        }
                        ?>>
                            <?= $pembayaranData["status_bayar"]; ?>
                        </td>
                        <td>
                            <a href="crud/edittransaksi.php?id=<?= $id ?>&idpesanan=<?= $row["idpesanan"]; ?>">Edit</a> | 
                            <a href="crud/hapuspesanan.php?id=<?= $id ?>&idpesanan=<?= $row["idpesanan"]; ?>" onclick="return confirm('apakah anda yakin ingin menghapus?');">Hapus</a> | 
                            <a href="crud/editbyr.php?id=<?= $id ?>&idpembayaran=<?= $row["idpesanan"]; ?>">Ubah Status Bayar</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </table>
                <div class="column" style="margin: 15px 15px;">
                    <a href="cetak.php" style="padding: 0 30px;" target="blank_"><button class="tambah">Cetak Laporan</button></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Ends -->
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("transaksiTable");
            switching = true;
            dir = "asc"; 
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
    <script>
    function sortTabletgl(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("transaksiTable");
            switching = true;
            dir = "asc"; 
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    
                    // Convert date strings to JavaScript Date objects for comparison
                    var dateX = new Date(x.innerHTML);
                    var dateY = new Date(y.innerHTML);

                    if (dir == "asc") {
                        if (dateX > dateY) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (dateX < dateY) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</body>
</html>