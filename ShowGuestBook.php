<?php

use Koneksi\Koneksi;

require_once __DIR__ . '/config/Koneksi.php';

$db = Koneksi::getDb();

$limit_page = 5;

$page = isset($_GET["page"]) ? $_GET["page"] : 1;

$halaman_awal = ($page > 1) ? ($page * $limit_page) - $limit_page : 0;

$previous = $page - 1;

$next = $page + 1;

$data = $db->prepare("SELECT * FROM guestbooks");

$data->execute();

$total_data = $data->rowCount();

$total_halaman = ceil($total_data / $limit_page);

$guestbooks = $db->prepare("SELECT * FROM guestbooks LIMIT $halaman_awal, $limit_page");

$guestbooks->execute();

$guestbooks = $guestbooks->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Guest Book</title>
    <style>
        
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
        table#t01 tr:nth-child(even) {
            background-color: #eee;
        }
        table#t01 tr:nth-child(odd) {
            background-color: #fff;
        }
        table#t01 th {
            background-color: black;
            color: white;
        }
        .pagination {
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1 align="center">Guest Book</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = $halaman_awal + 1;
            foreach ($guestbooks as $guestbook):
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $guestbook->name; ?></td>
                <td><?= $guestbook->email; ?></td>
                <td><?= $guestbook->comment; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $previous; ?>">Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $total_halaman): ?>
            <a href="?page=<?= $next; ?>">Next</a>
        <?php endif; ?>
</body>
</html>