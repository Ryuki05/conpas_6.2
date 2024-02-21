<?php
declare(strict_types=1);
session_start();
require_once ('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
$PlayerID = $_SESSION['PlayerID'];
// ユーザーデータを取得するクエリ
$pdo = connect();  // この行を追加して、PDOオブジェクトを取得
$userStatement = $pdo->prepare('SELECT * FROM Record WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$userRow = $userStatement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/common.css">
    <title>addition</title>
</head>
<body>
    <h1 class="text_center"><span class="span">N</span>ote</h1>
    <div>
        <form action="note.php" method="GET">
            <div class="flex_center border overflow">
                <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                <label>ファイル名:<input type="text" name="Category"></label>
                <label>記録日:<input type="date" name="Record_Date"></label>
                <label>内容:<br><textarea type="text" name="NoteContent" cols="30" rows="8" wrap="30" placeholder="入力"></textarea></label>
            </div>
            <div class="submit">    
                <input type="submit" value="更新">
            </div>
        </form>          
    </div>
</body>
</html>
<!-- 選手ID (PlayerID)
ユーザー名 (Username)
パスワード (Password)  -->