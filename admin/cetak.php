<?php
require ("function.php");
//mengambil library mpdf dari folder vendor
require_once __DIR__ . '../../vendor/autoload.php';
// mengambil data dalam URL
$id = $_GET["id"];
// query data berdasar
$pembayaran = query('SELECT * FROM pembayaran;');
$transaksi = query('SELECT * FROM pesanan
    JOIN customer ON (customer.idcustomer = pesanan.customer_idcustomer)
    JOIN paket_layanan ON (paket_layanan.idpaket = pesanan.paket_layanan_idpaket)
    JOIN tambahan ON (tambahan.idtambahan = pesanan.tambahan_idtambahan)
    ORDER BY pesanan.tanggal_acara;');

//hari ini
$day = date('d F Y');
//membuat file pdf baru
$mpdf = new \Mpdf\Mpdf();
//isi dokumen yang dicetak
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Adeabbasy.project</title>
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
        <div class="judul">Laporan Transaksi</div>
            <div class="tanggal">Tanggal: '.$day.'</div>
                <table class="tabel">
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Pesanan</th>
                        <th>Tambahan</th>
                        <th>Tanggal Acara</th>
                        <th>Tanggal Pesan</th>
                        <th>Total Harga</th>
                        <th>Status Bayar</th>
                    </tr>';
        $i = 1;
        foreach ($transaksi as $row) {
            $idpsn = $row['idpesanan'];
            $sts = query("SELECT status_bayar FROM pembayaran WHERE pesanan_idpesanan = $idpsn;");
            $status_bayar = $sts ? $sts[0]['status_bayar'] : 'Belum Dibayar';
            $tac = date('d F Y', strtotime($row["tanggal_acara"]));
            $tap = date('d F Y', strtotime($row["tanggal_pesanan"]));
            $toh = number_format($row["total_harga"], 0, ',', '.');
$html .= '<tr class="isitabel">
            <td>'.$i++.'.</td>
            <td>'.$row["nama_cust"].'</td>
            <td>'.$row["nama_paket"].'</td>
            <td>'.$row["nama_tambahan"].'</td>
            <td>'.$tac.'</td>
            <td>'.$tap.'</td>
            <td>Rp. '.$toh.',-</td>
            <td>'.$status_bayar.'</td>
        </tr>';
}
$html .= '</table>
    <div class="footer">Dokumen ini dicetak pada tanggal '.$day.'</div>
</body>
</html>';
//mencetak pdf dengan $html adalah dokumen isiannya
$mpdf->WriteHTML($html);
//menyimpan dalam format pdf
$mpdf->Output();
?>
