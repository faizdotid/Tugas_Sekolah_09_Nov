<?php

require_once __DIR__ . '/config/Koneksi.php';
require_once __DIR__ . '/vendor/autoload.php';

use Koneksi\Koneksi;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if (($_POST["email"]) == ""){
    echo "<script>alert('Email tidak boleh kosong'); window.location.href='Order.php';</script>";
    die();
}
$id = $_POST['ticket'];
function genTicket($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$ticketcode = genTicket(30);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Anda Berhasil Dibuat</title>
    <style>
        /* show ticket after order with my email */
        .ticket {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .ticket p {
            font-size: 20px;
        }
        .ticket a {
            text-decoration: none;
            color: #000;
            font-size: 20px;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .ticket a:hover {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php
    $db = Koneksi::getDb();
    $sql = "SELECT * FROM ticket where id = '$id'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $tickets = $stmt->fetchAll(PDO::FETCH_OBJ);
    ?>
    <?php foreach ($tickets as $ticket) : ?>
        <div class="ticket">
            <p>Ticket Anda Berhasil Dibuat</p>
            <p>Email Anda : <?= $_POST['email'] ?></p>
            <p>Judul : <?= $ticket->judul ?></p>
            <p>Harga : Rp. <?= $ticket->harga ?> </p>
            <p> Studio : <?= $ticket->studio ?> </p>
            <p>Rating : <?= $ticket->rating ?> </p>
            <p>Kode Tiket Anda : <?= $ticketcode ?></p>
            <?php
            $qr = QrCode::create($ticketcode);
            $writer = new PngWriter();
            $writer->write($qr)->saveToFile("qrcode.png");
            ?>
            <img src="qrcode.png" alt="qrcode">
            <a href="Order.php">Order Lagi</a>
        </div>
    <?php endforeach; ?>
</body>
</html>