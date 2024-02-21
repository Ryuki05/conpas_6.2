<?php
declare(strict_types=1);
session_start();
require_once ('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
$PlayerID = $_SESSION['PlayerID'];

// フォームからのデータを受け取る
$Match_Day = $_POST['Match_Day'] ?? '';
$Match_Name = $_POST['Match_Name'] ?? '';
$Match_Results = $_POST['Match_Results'] ?? '';
$Reflect = $_POST['Reflect'] ?? '';

// 必要ならばデータの検証を行う
// 例えば、Match_Dayが日付形式かどうかを確認するなど

// データベースにレコードを挿入
$pdo = connect();  // この行を追加して、PDOオブジェクトを取得
$statement = $pdo->prepare('INSERT INTO Record (`PlayerID`,`Match_Name`,`Match_Day`, `Match_Results`, `Reflect`) VALUES (:PlayerID,:Match_Name,:Match_Day, :Match_Results, :Reflect)');
$statement->bindValue(':PlayerID', $PlayerID, PDO::PARAM_INT);
$statement->bindValue(':Match_Day', $Match_Day, PDO::PARAM_STR);
$statement->bindValue(':Match_Name', $Match_Name, PDO::PARAM_STR);
$statement->bindValue(':Match_Results', $Match_Results, PDO::PARAM_STR);
$statement->bindValue(':Reflect', $Reflect, PDO::PARAM_STR);
$statement->execute(); // データベースに挿入

// リダイレクト
header('Location: Record_look.php');
exit(); // リダイレクト後に実行を停止するために必要
?>
