<?php
declare(strict_types=1);

require_once ('func.php');

// PlayerIDのGETパラメータを取得
$PlayerID = $_GET['PlayerID'];

//プロフィール処理//
// ユーザーデータを取得するクエリ
$pdo = connect();  // この行を追加して、PDOオブジェクトを取得
$userStatement = $pdo->prepare('SELECT * FROM players WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$userRow = $userStatement->fetch(PDO::FETCH_ASSOC);
// 各パラメータを取得してから表示
$Username = isset($userRow['Username']) ? htmlspecialchars($userRow['Username'], ENT_QUOTES, 'UTF-8') : 'ユーザー名が見つかりませんでした';
$Email = isset($userRow['Email']) ? htmlspecialchars($userRow['Email'], ENT_QUOTES, 'UTF-8') : '';
$Weight = isset($userRow['Weight']) ? htmlspecialchars($userRow['Weight'], ENT_QUOTES, 'UTF-8') : '';
$Height = isset($userRow['Height']) ? htmlspecialchars($userRow['Height'], ENT_QUOTES, 'UTF-8') : '';
$MuscleMass = isset($userRow['MuscleMass']) ? htmlspecialchars($userRow['MuscleMass'], ENT_QUOTES, 'UTF-8') : '';
$BMI = isset($userRow['BMI']) ? htmlspecialchars($userRow['BMI'], ENT_QUOTES, 'UTF-8') : '';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
</head>
<body>
    <form action="profile/profile_c.php" method="GET">

        <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">

        <img src="images/conpas.jpg" alt="アイコン">
        <p>ユーザー名: <?= $Username; ?></p>
        <p>PlayerID: <?= $PlayerID; ?></p>
        <p>Email: <?= $Email; ?></p>
        <p>体重(KG): <?= $Weight; ?></p>
        <p>身長(CM): <?= $Height; ?></p>
        <p>筋肉量(KG): <?= $MuscleMass; ?></p>
        <p>BMI: <?= $BMI; ?></p>
        <input type="submit" value="プロフィール編集">
    </form>
</body>
</html>
