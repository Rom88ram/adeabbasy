<?php
    require ("function.php");
    //mengambil library mpdf dari folder vendor
    require_once __DIR__ . '../../vendor/autoload.php';
    // mengambil data dalam URL
    $id = $_GET["id"];
    // query data berdasar
    $customer = query ('SELECT * FROM customer ;');
    $jmlcustomer = 0;
    foreach($customer as $row) :
        $jmlcustomer++;
    endforeach;

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
        <div class="judul">Laporan Customer</div>
            <div class="tanggal">Tanggal: '.$day.'</div>
                <table class="tabel">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat Pelanggan</th>
                        <th>No. HP</th>
                        <th>Email</th>
                    </tr>';
        $i = 1;
        foreach($customer as $row) {
$html .= '<tr class="isitabel">
            <td>'.$i++.'.</td>
            <td>'.$row["nama_cust"].'</td>
            <td>'.$row["alamat_cust"].'</td>
            <td>'.$row["no_hp"].'</td>
            <td>'.$row["email"].'</td>
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
