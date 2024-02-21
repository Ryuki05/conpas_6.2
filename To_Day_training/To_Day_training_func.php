<?php
declare(strict_types=1);
session_start();
require_once ('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
$PlayerID = $_SESSION['PlayerID'];

// ユーザーデータを取得するクエリ
$pdo = connect();  // この行を追加して、PDOオブジェクトを取得
$userStatement = $pdo->prepare('SELECT * FROM players WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$userRow = $userStatement->fetch(PDO::FETCH_ASSOC);

// フォームからのデータを受け取る
$sessionDate = $_POST['SessionDate'] ?? '';
$intensity = $_POST['Intensity'] ?? '';
$sessionPurpose = $_POST['SessionPurpose'] ?? '';
$reflection = $_POST['Reflection'] ?? '';
$time = $_POST['Time'] ?? '';
$weekNumber = $_POST['WeekNumber'] ?? '';

// データベースにレコードを挿入
$statement = $pdo->prepare('INSERT INTO trainingsessions (`PlayerID`,`SessionDate`, `Intensity`, `SessionPurpose`, `Reflection`, `Time`, `WeekNumber`) VALUES (:PlayerID,:SessionDate, :Intensity, :SessionPurpose, :Reflection, :Time, :WeekNumber)');
$statement->bindValue(':PlayerID', $PlayerID, PDO::PARAM_STR);
$statement->bindValue(':SessionDate', $sessionDate, PDO::PARAM_STR);
$statement->bindValue(':Intensity', $intensity, PDO::PARAM_STR);
$statement->bindValue(':SessionPurpose', $sessionPurpose, PDO::PARAM_STR);
$statement->bindValue(':Reflection', $reflection, PDO::PARAM_STR);
$statement->bindValue(':Time', $time, PDO::PARAM_STR);
$statement->bindValue(':WeekNumber', $weekNumber, PDO::PARAM_INT);

$statement->execute(); // データベースに挿入
header('Location: look.php');
exit(); // リダイレクト後に実行を停止するために必要

// 以下は記録一覧の表示部分です
?>