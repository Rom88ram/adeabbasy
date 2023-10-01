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
    $adminnama = query ("SELECT * FROM admin WHERE idadmin = $id")[0];
    $admin = query ('SELECT * FROM admin ;');
    $paket = query ('SELECT * FROM paket_layanan ;');
    $tambahan = query ('SELECT * FROM tambahan ;');
    $pesanan = query ('SELECT * FROM pesanan ;');
    $customer = query ('SELECT * FROM customer ;');
    $jmlpaket = 0;
    $jmltambahan = 0;
    $jmlpesanan = 0;
    $jmlcustomer = 0;
    foreach($paket as $row) :
        $jmlpaket++;
    endforeach;
    foreach($tambahan as $row) :
        $jmltambahan++;
    endforeach;
    foreach($pesanan as $row) :
        $jmlpesanan++;
    endforeach;
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
            <a class="navbar-brand" href="index.php?id=<?= $id; ?>" style="text-align: center;">Adeabbasy.project</a>
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
            <a class="side-link" href="#"><div class="side-list">
                Dashboard
            </div></a>
            <a class="side-link" href="paket.php?id=<?= $id; ?>"><div class="side-list">
                Paket Layanan
            </div></a>
            <a class="side-link" href="transaksi.php?id=<?= $id; ?>"><div class="side-list">
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
            <h1>Dashboard</h1>
            <h5>Anda login sebagai <?= $adminnama['username']; ?></h5>
        </div>
        <div class="container kontener">
            <div class="row">
                <div class="column">
                    <div class="cards">
                        <div class="contentcard">
                            <div class="jumlahcard"><?= $jmlpaket; ?></div>
                            <div class="cardicon"><i class="fa-solid fa-shop fa-2xl"></i></div>
                            <div class="namacard">Paket Layanan</div>
                            <a href="paket.php?id=<?= $id; ?>" style="color: white;"><div class="cardlink">Show More <i class="fa-solid fa-arrow-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="cards">
                        <div class="contentcard">
                            <div class="jumlahcard"><?= $jmltambahan; ?></div>
                            <div class="cardicon"><i class="fa-solid fa-puzzle-piece fa-2xl"></i></div>
                            <div class="namacard">Tambahan</div>
                            <a href="paket.php?id=<?= $id; ?>#tambahan" style="color: white;"><div class="cardlink">Show More <i class="fa-solid fa-arrow-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="cards">
                        <div class="contentcard">
                            <div class="jumlahcard"><?= $jmlpesanan; ?></div>
                            <div class="cardicon"><i class="fa-solid fa-cart-shopping fa-2xl"></i></div>
                            <div class="namacard">Transaksi</div>
                            <a href="transaksi.php?id=<?= $id; ?>#tambahan" style="color: white;"><div class="cardlink">Show More <i class="fa-solid fa-arrow-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="cards">
                        <div class="contentcard">
                            <div class="jumlahcard"><?= $jmlcustomer; ?></div>
                            <div class="cardicon"><i class="fa-solid fa-user-tag fa-2xl"></i></div>
                            <div class="namacard">Customer</div>
                            <a href="customer.php?id=<?= $id; ?>" style="color: white;"><div class="cardlink">Show More <i class="fa-solid fa-arrow-right"></i></div></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row isi">
                <div class="column" style="margin: 15px 15px;"><h2>Admin</h2></div>
                <table class="tabel" style="margin: 30px 30px;">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach($admin as $row) :
                    ?>
                    <tr class="isitabel">
                        <td><?= $i; ?>.</td>
                        <td><?= $row["username"]; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["email"]; ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <!-- Content Ends -->
    <script>
        function openside() {
            document.getElementById("sidelist").style.height = "100vh";
            document.getElementById("sidelist").style.display = "block";
            document.getElementById("sidebtn").style.display = "none";
        }

        function closeside() {
            document.getElementById("sidelist").style.display = "none";
            document.getElementById("sidebtn").style.display = "block";
        }
    </script>
</body>
</html>