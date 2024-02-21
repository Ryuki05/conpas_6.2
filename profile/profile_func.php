<?php
// declare(strict_types=1);
session_start();
require_once ('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
// $PlayerID = isset($_GET['PlayerID']) ? $_GET['PlayerID'] : '';
$PlayerID = $_SESSION['PlayerID'];

$pdo = connect();
$userStatement = $pdo->prepare('SELECT * FROM Players WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$userRow = $userStatement->fetch(PDO::FETCH_ASSOC);

$ImgName = isset($userRow['ImgName']) ? htmlspecialchars($userRow['ImgName'], ENT_QUOTES, 'UTF-8') : '';
$Username = isset($userRow['Username']) ? htmlspecialchars($userRow['Username'], ENT_QUOTES, 'UTF-8') : '';
$Email = isset($userRow['Email']) ? htmlspecialchars($userRow['Email'], ENT_QUOTES, 'UTF-8') : '';
$Weight = isset($userRow['Weight']) ? htmlspecialchars($userRow['Weight'], ENT_QUOTES, 'UTF-8') : '';
$Height = isset($userRow['Height']) ? htmlspecialchars($userRow['Height'], ENT_QUOTES, 'UTF-8') : '';
$MuscleMass = isset($userRow['MuscleMass']) ? htmlspecialchars($userRow['MuscleMass'], ENT_QUOTES, 'UTF-8') : '';
// プロフィールの更新処理
try{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // フォームからのデータを取得

        $ImgName = isset($_GET['ImgName']) ? $_GET['ImgName'] : '';
        $Username = isset($_GET['Username']) ? $_GET['Username'] : '';
        $Email = isset($_GET['Email']) ? $_GET['Email'] : '';
        $Weight = isset($_GET['Weight']) ? floatval($_GET['Weight']) : 0.0;
        $Height = isset($userRow['Height']) ? intval($userRow['Height']) : '';
        $MuscleMass = isset($_GET['MuscleMass']) ? $_GET['MuscleMass'] : '';
        $HeightInMeter = $Height / 100.0;
        $BMI = $Weight / ($HeightInMeter * $HeightInMeter);

        // データベースに更新を反映
        $updateStatement = $pdo->prepare('UPDATE Players SET ImgName=:ImgName, Username=:Username, Email=:Email, Weight=:Weight, Height=:Height, MuscleMass=:MuscleMass, BMI=:BMI WHERE PlayerID=:PlayerID;');
        $updateStatement->bindParam(':ImgName', $ImgName, PDO::PARAM_STR);
        $updateStatement->bindParam(':Username', $Username, PDO::PARAM_STR);
        $updateStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
        $updateStatement->bindParam(':Email', $Email, PDO::PARAM_STR);
        $updateStatement->bindParam(':Weight', $Weight, PDO::PARAM_STR);
        $updateStatement->bindParam(':Height', $Height, PDO::PARAM_STR);
        $updateStatement->bindParam(':MuscleMass', $MuscleMass, PDO::PARAM_STR);
        $updateStatement->bindParam(':BMI', $BMI, PDO::PARAM_STR);
        $updateStatement->execute();
        // 更新後に再度ユーザーデータを取得
        $userStatement = $pdo->prepare('SELECT * FROM Players WHERE PlayerID = :PlayerID');
        $userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
        $userStatement->execute();
        $userRow = $userStatement->fetch(PDO::FETCH_ASSOC);
        $ImgName = isset($userRow['ImgName']) ? htmlspecialchars($userRow['ImgName'], ENT_QUOTES, 'UTF-8') : '';
        $Username = isset($userRow['Username']) ? htmlspecialchars($userRow['Username'], ENT_QUOTES, 'UTF-8') : '';
        $Email = isset($userRow['Email']) ? htmlspecialchars($userRow['Email'], ENT_QUOTES, 'UTF-8') : '';
        $Weight = isset($userRow['Weight']) ? htmlspecialchars($userRow['Weight'], ENT_QUOTES, 'UTF-8') : '';
        $Height = isset($userRow['Height']) ? htmlspecialchars($userRow['Height'], ENT_QUOTES, 'UTF-8') : '';
        $MuscleMass = isset($userRow['MuscleMass']) ? htmlspecialchars($userRow['MuscleMass'], ENT_QUOTES, 'UTF-8') : '';
        $BMI = isset($userRow['BMI']) ? htmlspecialchars($userRow['BMI'], ENT_QUOTES, 'UTF-8') : '';
        // リダイレクト
        header('Location: profile.php');
        exit(); // リダイレクト後に実行を停止するために必要
    }

}
catch (PDOException $e) {
        // エラーハンドリング
        echo '更新中にエラーが発生しました: ' . $e->getMessage();
    }
?>
