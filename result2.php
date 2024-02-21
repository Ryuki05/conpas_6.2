<?php 
declare(strict_types=1); 
session_start();
require_once dirname(__FILE__) . '/func.php';

// メインルーチン
// try {
if (!isset($_GET['PlayerID']) || trim($_GET['PlayerID']) === '') {
    echo 'PlayerIDが入力されていません。<p><a href="./login.html">戻る</a></p>';
    return;
}
if (!isset($_GET['Password']) || trim($_GET['Password']) === '') {
    echo 'Passwordが入力されていません。<p><a href="./login.html">戻る</a></p>';
    return;
}

$_SESSION['PlayerID'] = $_GET['PlayerID'];
$PlayerID = $_SESSION['PlayerID'];
$Password = $_GET['Password'];

$pdo = connect();
$statement = $pdo->prepare("SELECT PlayerID, Password FROM Players WHERE PlayerID = :PlayerID AND Password = :Password");
$statement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$statement->bindParam(':Password', $Password, PDO::PARAM_STR);
$statement->execute();

if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    // header("Location: profile.php?PlayerID={$row['PlayerID']}");
    $_SESSION['PlayerID'] = $row['PlayerID'];
    header("Location: home/home.php");
    exit();
} 
else {
    header("Location: login.html"); // ログイン失敗時のリダイレクト
    exit();
} 
// }catch(PDOException) {
//     $result = '正しく入力してください';
// }

