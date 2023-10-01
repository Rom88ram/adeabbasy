<?php
require ("function.php");
require_once __DIR__ . '../../vendor/autoload.php';

// Get data from the URL
$id = $_GET["id"];
$idpesanan = $_GET["idpesanan"];
$tgla = $_GET["tgla"];
$tbh = $_GET["tbh"];
$tot = $_GET["tot"];

// Query data
$pembayaran = query('SELECT * FROM pembayaran;');
$pesanan = query('SELECT * FROM pesanan
    JOIN customer ON (customer.idcustomer = pesanan.customer_idcustomer)
    JOIN paket_layanan ON (paket_layanan.idpaket = pesanan.paket_layanan_idpaket)
    JOIN tambahan ON (tambahan.idtambahan = pesanan.tambahan_idtambahan)
    WHERE pesanan.idpesanan = ' . $idpesanan);
$stats = query ("SELECT * FROM pembayaran WHERE pesanan_idpesanan = $idpesanan;")[0];
$status = "";
if ($stats["status_bayar"] == "Sudah Dibayar") {
    $status = "Sudah Diproses";
} else {
    $status = "Belum Diproses";
}
$cust = query ("SELECT * FROM customer WHERE idcustomer = $id;")[0];
//hari ini
$day = date('d F Y');
//membuat file pdf baru
$mpdf = new \Mpdf\Mpdf();
//isi dokumen yang dicetak
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nota Transaksi</title>
    <style>
        .tabel {
            border-collapse: collapse;
            width: 100%;
        }
        .tabel td, th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .tabel th {
            background-color: #f2f2f2;
        }
        .tabel tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .tabel tr:hover {
            background-color: #ddd;
        }
        .judul {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .tanggal {
            margin-bottom: 10px;
            text-align: right;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container kontener">
        <div class="judul"><u>Nota Transaksi</u></div>
            <div class="tanggal">Tanggal: '.$day.'
            <br>Id Pesanan: '.$idpesanan.'
            </div>
                <table>
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>:</td>
                            <td>'.$cust["nama_cust"].'</td>
                        </tr>
                        <tr>
                            <td>Tanggal Acara</td>
                            <td>:</td>
                            <td>'.date('d F Y', strtotime($tgla)).'</td>
                        </tr>
                        <tr>
                            <td>Tambahan</td>
                            <td>:</td>
                            <td>'.$tbh.'</td>
                        </tr>
                        <tr>
                            <td>Total Harga</td>
                            <td>:</td>
                            <td>Rp. '.number_format($tot,0,',','.').',-</td>
                        </tr>
                        <tr>
                            <td>Status Pembayaran</td>
                            <td>:</td>
                            <td>'.$status.'
                            </td>
                        </tr>
                        <tr>
                            <td>Untuk informasi lebih<br> lanjut silahkan hubungi admin</td>
                            <td>:</td>
                            <td>085646857429</td>
                        </tr>';
$html .= '</table>
    <div class="footer">Nota dicetak pada tanggal '.$day.'</div>
</body>
</html>';
//mencetak pdf dengan $html adalah dokumen isiannya
$mpdf->WriteHTML($html);
//menyimpan dalam format pdf
$mpdf->Output();
?>
