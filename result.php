<?php

declare(strict_types=1);

require_once dirname(__FILE__) . '/func.php';

// メインルーチン

if (!isset($_GET['ImgName']) || trim($_GET['ImgName']) === '') {
    echo 'ImgNameが入力されていません。';
    return;
}
if (!isset($_GET['PlayerID']) || trim($_GET['PlayerID']) === '') {
    echo 'PlayerIDが入力されていません。';
    return;
}
if (!isset($_GET['Username']) || trim($_GET['Username']) === '') {
    echo 'Usernameが入力されていません。';
    return;
}
if (!isset($_GET['Password']) || trim($_GET['Password']) === '') {
    echo 'Passwordが入力されていません。';
    return;
}
if (!isset($_GET['Email']) || trim($_GET['Email']) === '') {
    echo 'Emailが入力されていません。';
    return;
}
if (!isset($_GET['Weight']) || trim($_GET['Weight']) === '') {
    echo 'Weightが入力されていません。';
    return;
}
if (!isset($_GET['Height']) || trim($_GET['Height']) === '') {
    echo 'Heightが入力されていません。';
    return;
}
if (!isset($_GET['MuscleMass']) || trim($_GET['MuscleMass']) === '') {
    echo 'MuscleMassが入力されていません。';
    return;
}
$ImgName = $_GET['ImgName'];
$PlayerID = $_GET['PlayerID'];
$Username = $_GET['Username'];
$Password = $_GET['Password'];
$Email = $_GET['Email'];
$Weight = $_GET['Weight'];
$Height = $_GET['Height'];
$MuscleMass = $_GET['MuscleMass'];

// BMIの計算を追加
$HeightInMeter = $Height / 100;
$BMI = $Weight / ($HeightInMeter * $HeightInMeter);

$pdo = connect();
$statement = $pdo->prepare('INSERT INTO Players(`ImgName`, `PlayerID`, `Username`, `Password`, `Email`, `Weight`, `Height`, `MuscleMass`, `BMI`) VALUES(:ImgName,:PlayerID, :Username, :Password, :Email, :Weight, :Height, :MuscleMass, :BMI)');
$statement->bindValue(':ImgName', $ImgName, PDO::PARAM_INT);
$statement->bindValue(':PlayerID', $PlayerID, PDO::PARAM_INT);
$statement->bindValue(':Username', $Username, PDO::PARAM_STR);
$statement->bindValue(':Password', $Password, PDO::PARAM_STR);
$statement->bindValue(':Email', $Email, PDO::PARAM_STR);
$statement->bindValue(':Weight', $Weight, PDO::PARAM_STR);
$statement->bindValue(':Height', $Height, PDO::PARAM_STR);
$statement->bindValue(':MuscleMass', $MuscleMass, PDO::PARAM_STR);
$statement->bindValue(':BMI', $BMI, PDO::PARAM_STR);
$statement->execute();

// 処理が正常に完了した場合のリダイレクト
if ($statement->rowCount() > 0) {
    // リダイレクト先のURLを指定してリダイレクト
    header('Location: login.php');
    exit(); // リダイレクト後にスクリプトの実行を終了するためにexit()を呼び出す
}

session_start();
$_SESSION['PlayerID'] = $PlayerID;
?>