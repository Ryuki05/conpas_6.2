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
    <div class="main_div">
        <img src="images/conpas.jpg">
        <h1>now login</h1>
        <main>
            <form name="" action="result.php" method="GET">
                <div class="text new_login">
                    <label style="display: none;"><input type="text" name="ImgName" value="../images/conpas.jpg"></label>
                    <label>選手ID: <input type="text" name="PlayerID"></label>
                    <label>ユーザー名: <input type="text" name="Username"></label>
                    <label>パスワード: <input type="password" name="Password"></label>
                    <label>メールアドレス:<input type="email" name="Email"></label>
                    <label>体重(kg):<input type="text" name="Weight"></label>
                    <label>身長(cm):<input type="text" name="Height"></label>
                    <label>筋肉量(kg):<input type="text" name="MuscleMass"></label>
                    <!-- <label>BMI:<input type="hidden" name="BMI"></label> -->
                </div>
                <input class="btn" type="submit" name="operation" value="Sign-up">
            </form>
        </main>
    </div>
</body>
</html>
<!-- 選手ID (PlayerID)
ユーザー名 (Username)
パスワード (Password)  -->