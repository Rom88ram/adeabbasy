<?php
    require ("admin/function.php");
    session_start();
    if(!isset($_SESSION['loginc'])){
        header("Location:login.php");
        exit;
    }
    $idc = $_GET["idc"];
    $cust = query ("SELECT * FROM customer WHERE idcustomer = $idc;")[0];
    $transt = query ("SELECT * FROM pesanan WHERE customer_idcustomer = $idc;");
    $wedding = query ('SELECT * FROM paket_layanan WHERE nama_paket LIKE "Wedding%";');
    $paket = query ('SELECT * FROM paket_layanan WHERE NOT nama_paket LIKE "Wedding%";');
    $jmltransaksi = 0;
    foreach($transt as $row) :
        $jmltransaksi++;
    endforeach;
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
        <style>
            body {
                font-family: 'Montserrat', sans-serif;
                background: #f8f8f8;
            }
            .card {
                border-radius: 10px;
                box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21), 0 0 0 1px rgba(0, 0, 0, 0.06);
                color: black;
                font-weight: 600;
                backdrop-filter: blur(5px);
                transition: all 0.3s;
            }
            .card:hover {
                transform: scale(1.05);
                box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2), 0 0 0 2px rgba(0, 0, 0, 0.1);
            }
            h2 {
                font-size: 35px;
            }
            .atas {
                padding: 13px;
            }
            footer {
                text-align: center;
                padding: 3px 0;
                background-color: #212529;
                color: white;
            }
            input {
                padding: 8px 10px;
                border-radius: 10px;
                border: none;
                outline: none;
            }
            .form-container {
                max-width: 600px;
                margin: 0 auto;
                padding: 30px;
                text-align: left;
                background-color: #325976;
                box-shadow: 0 0 20px rgba(29, 29, 29, 0.21);
                border-radius: 10px;
            }
            .gambar {
                width: 100%;
                height: 250px;
                border-radius: 10px;
                box-shadow: 0 0 6px 0 rgba(29, 29, 29, 0.21);
            }
            .form-container h3 {
                margin-bottom: 20px;
            }
            .form-container table {
                display: flex;
                width: 100%;
            }
            .form-container td {
                vertical-align: top;
                padding: 5px 10px;
                text-align: left;
                border-bottom: 1px solid #eee;
            }
            .form-container form {
                gap: 9px;
                flex-direction: column;
            }
            .judul{
                margin: 30px 0;
            }
            .nolink a {
                text-decoration: none;
                color: black;
            }
            .foot1 {
                padding-top: 5px;
            }
        </style>
        <title>Adeabbasy.project</title>
    </head>
    <body style="background: white;">
        <!-- navbar starts -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-light sticky-top atas">
            <div class="container-fluid" style="font-size: 20px;">
                <a class="navbar-brand" href="indexlog.php?idc=<?= $idc?>" style="font-size: 22px;">Adeabbasy.project</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="indexlog.php?idc=<?= $idc?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="indexlog.php?idc=<?= $idc?>#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="indexlog.php?idc=<?= $idc?>#layanan">Layanan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Lainnya
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pesanan.php?idc=<?= $idc?>">Pesanan</a></li>
                                <li><a class="dropdown-item" href="indexlog.php?idc=<?= $idc?>#lokasi">Lokasi</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class='d-flex' role='search'>
                        <a href='logout.php'><button class='btn btn-outline-danger' style='margin-right: 20px;'>Logout</button></a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar ends -->
        <div id="home" class="text-center text-light justify-content-between container" style="height: 100%; background: #526D82; box-shadow: 0 0 20px 0 rgba(29, 29, 29, 0.21); display: flex; 
        <?php
        if ($jmltransaksi <= 2) {
            echo 'padding-bottom: 190px;';
        }
        else {
            echo '';
        }
        ?>">
            <div class="row align-items-center mb-5">
                <h2 class="judul">Pesanan Anda</h2>
                <?php
                $trans = "SELECT * FROM pesanan WHERE customer_idcustomer = $idc;";
                $retvalt = mysqli_query($conn, $trans);
                while($row = mysqli_fetch_array($retvalt)){
                    $pkt = query ("SELECT * FROM paket_layanan WHERE idpaket = $row[paket_layanan_idpaket];")[0];
                    $tbh = query ("SELECT * FROM tambahan WHERE idtambahan = $row[tambahan_idtambahan];")[0];
                    $stats = query ("SELECT * FROM pembayaran WHERE pesanan_idpesanan = $row[idpesanan];")[0];
                ?>
                <div class="col-md-6 mt-2 pt-2">
                    <img class="gambar" src="assets/<?= $pkt['gambar_paket']; ?>" alt="error">
                </div>
                <div class="col-md-6 mt-2 pt-2 align-items-left form-container">
                    <h3><?= $pkt["nama_paket"]; ?></h3>
                    <table>
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>:</td>
                            <td><?= $cust["nama_cust"]; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Acara</td>
                            <td>:</td>
                            <td><?= date('d F Y', strtotime($row["tanggal_acara"])); ?></td>
                        </tr>
                        <tr>
                            <td>Tambahan</td>
                            <td>:</td>
                            <td><?= $tbh["nama_tambahan"]; ?></td>
                        </tr>
                        <tr>
                            <td>Total Harga</td>
                            <td>:</td>
                            <td>Rp. <?= number_format($row["total_harga"],0,',','.'); ?>,-</td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>:</td>
                            <td>
                                <?php
                                if ($stats["status_bayar"] == "Sudah Dibayar") {
                                    echo "Sudah Diproses";
                                } else {
                                    echo "Belum Diproses";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><a href='admin/nota.php?id=<?= $idc ?>&idpesanan=<?= $row["idpesanan"]; ?>&tgla=<?= $row["tanggal_acara"]; ?>&tbh=<?= $tbh["nama_tambahan"]; ?>&tot=<?= $row["total_harga"]; ?>' target=”_blank”><button class='btn btn-success' style='margin-right: 20px;'>Nota</button></a></td>
                        </tr>
                        <tr>
                            <td>Untuk informasi lebih<br> lanjut silahkan hubungi admin</td>
                            <td>:</td>
                            <td><a href="https://wa.me/6282227774402" target=”_blank” style="text-decoration: none; color: white;"><p style="font-size: 17px;"><span class="fa-brands fa-whatsapp fa-lg"></span> 085646857429</p></a></td>
                        </tr>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- footer -->
        <footer>
            <div class="foot1">
                <p>Author: Romi Ramadhan</p>
                <p>ramadhanromi77@gmail.com</p>
            </div>
        </footer>
        <!-- footer ends -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>