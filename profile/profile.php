<?php
declare(strict_types=1);
session_start();
require_once ('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
// $_SESSION['PlayerID'] = $_GET['PlayerID'];
$PlayerID = $_SESSION['PlayerID'];
// ユーザーデータを取得するクエリ
$pdo = connect();  // この行を追加して、PDOオブジェクトを取得
$userStatement = $pdo->prepare('SELECT * FROM players WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$userRow = $userStatement->fetch(PDO::FETCH_ASSOC);

// 各パラメータを取得してから表示
$ImgName = isset($userRow['ImgName']) ? htmlspecialchars($userRow['ImgName'], ENT_QUOTES, 'UTF-8') : '';
$Username = isset($userRow['Username']) ? htmlspecialchars($userRow['Username'], ENT_QUOTES, 'UTF-8') : 'ユーザー名が見つかりませんでした';
$Email = isset($userRow['Email']) ? htmlspecialchars($userRow['Email'], ENT_QUOTES, 'UTF-8') : '';
$Weight = isset($userRow['Weight']) ? htmlspecialchars($userRow['Weight'], ENT_QUOTES, 'UTF-8') : '';
$Height = isset($userRow['Height']) ? htmlspecialchars($userRow['Height'], ENT_QUOTES, 'UTF-8') : '';
$MuscleMass = isset($userRow['MuscleMass']) ? htmlspecialchars($userRow['MuscleMass'], ENT_QUOTES, 'UTF-8') : '';
$BMI = isset($userRow['BMI']) ? htmlspecialchars($userRow['BMI'], ENT_QUOTES, 'UTF-8') : '';

// // 画像アップロード処理
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     $uploadDir = 'images/';
//     $uploadFile = $uploadDir . basename($_FILES['fileToUpload']['name']);

//     if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile)) {
//     } else {
//     }
// }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/profile.css">
    <title>プロフィール</title>
</head>
<body>
    <main>
        <div>
            <form class="center" action="profile_c.php" method="GET">
                <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                <div class="center icon trans_img">
                    <img src="../images/<?= $ImgName; ?>" alt="アイコン">
                    <div class="text">
                        <p class="username">名前:<?= $Username; ?></p>
                        <p class="player_id">選手ID:<?= $PlayerID; ?></p>
                    </div>
                    <div class="border">
                        <p>メール:<?= $Email; ?></p>
                        <p>体重:<?= $Weight; ?>kg</p>
                        <p>身長:<?= $Height; ?>cm</p>
                        <p>筋肉量:<?= $MuscleMass; ?>kg</p>
                        <p>BMI:<?= $BMI; ?></p> 
                    </div>
                </div>
                <div class="btn">
                    <label><input type="submit" value=""><img src="../images/icon.png" alt=""></label>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
