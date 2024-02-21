<?php
declare(strict_types=1);
session_start();
$_SESSION['PlayerID'] = "";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Island+Moments&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <title>login</title>
</head>
<body>
    <div class=main_div>
        <img src="images/conpas.jpg">
        <h1>login</h1>
        <main>
            <form name="" action="result2.php" method="GET">
                <div class="text">
                    <label>選手ID: <input type="text" name="PlayerID"></label>
                    <label>Password: <input type="password" name="Password"></label>
                </div>
                <input class="btn" type="submit" name="operation" value="login">
            </form>
            <h2>まだアカウントをお持ちでないですか？<a href="new_login.php">登録</a></h2>
        </main>
    </div>
</body>
</html>