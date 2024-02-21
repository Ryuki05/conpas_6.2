<?php
declare(strict_types=1);

// セッションを開始
session_start();

// ログインしている場合、PlayerIDがセットされているか確認
if (isset($_SESSION['PlayerID'])) {
    $PlayerID = $_SESSION['PlayerID'];
} else {
    // ログインしていない場合はログインページにリダイレクト
    header('Location: login.php');
    exit();
}

// セッションIDの変更
session_regenerate_id(true);

// PlayerIDをセッションに保存
$_SESSION['PlayerID'] = $PlayerID;
// $_SESSION["ImgName"] = $ImgName;
?>