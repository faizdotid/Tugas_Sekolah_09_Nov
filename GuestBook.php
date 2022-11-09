<?php

//guest book

use Koneksi\Koneksi;

require_once __DIR__ . '/config/Koneksi.php';

$db = Koneksi::getDb();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['comment'];

    $sql = "INSERT INTO guestbooks (name, email, comment) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$name, $email, $message]);
    if ($stmt) {
        echo "<script>alert('Data Berhasil Ditambahkan');window.location.href='GuestBook.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Ditambahkan');window.location.href='GuestBook.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Book</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container form input {
            margin: 10px;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .container form textarea {
            margin: 10px;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .container form button {
            margin: 10px;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
        }
        .container form button:hover {
            background-color: #fff;
            color: #000;
        }
        h1 {
            text-align: center;
        }
        a {
            text-decoration: none;
            color: #000;
            font-size: 20px;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        a:hover {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>GuestBook</h1>
    <div class="container">
        <form action="" method="post">
            <input type="text" name="name" placeholder="Name">
            <input type="email" name="email" placeholder="Email">
            <textarea name="comment" id="" cols="30" rows="10" placeholder="Comment"></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>
        <a href="ShowGuestBook.php">Show Guest Book</a>
    </div>
    <!--href="ShowGuestBook.php"-->
    
</body>
</html>
