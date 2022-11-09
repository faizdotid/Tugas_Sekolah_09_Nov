<?php
require_once __DIR__ . '/config/Koneksi.php';
use Koneksi\Koneksi;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* make order form */
        .order {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .order form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .order form input {
            margin: 10px;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .order form input[type="submit"] {
            background-color: #000;
            color: #fff;
        }
        .order form input[type="submit"]:hover {
            background-color: #fff;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="order">
        <form action="OrderTicket.php" method="POST">
            <label for="email">Email Anda</label>
            <input type="email" id="email" name="email">
            <label for="ticket">Pilih Ticket</label>
            <select name="ticket" id="ticket">
                <?php
                $db = Koneksi::getDb();
                $sql = "SELECT * FROM ticket";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $tickets = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($tickets as $ticket) : ?>
                    <option value="<?= $ticket->id ?>"><?= $ticket->judul ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Order">
        </form>
    </div>
</body>
</html>