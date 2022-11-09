<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        /* make home page */
        .home {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .home a {
            text-decoration: none;
            color: #000;
            font-size: 20px;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .home a:hover {
            background-color: #000;
            color: #fff;
        }
        .home h1 {
            font-size: 50px;
            font-family: sans-serif;
            color: #000;
        }
    </style>

</head>
<body>
    <div class="home">
        <h1>Website Sederhana Order Ticket</h1>
        <a href="Order.php">Order Ticket</a>
        <a href="GuestBook.php">Guest Book</a>
        <a href="About-us.php">About My Website</a>
    </div>
</body>
</html>