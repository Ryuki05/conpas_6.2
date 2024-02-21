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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/common.css">
    <title>Record</title>
</head>
<body>
    <h1 class="text_center"><span><span class="span">T</span>o <span class="span">D</span>ay <span class="span">T</span>raining</span></h1>
    <!-- フォーム -->
    <div class="center">
        <form class="center" action="To_Day_training_func.php" method="POST"> <!-- method を POST に変更 -->
            <div class="flex_center border overflow">
                <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                <label>練習日:<input type="date" name="SessionDate"></label>
                <label>強度:
                    <select type="text" name="Intensity">
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                    </select>
                </label>
                <label>練習内容/目的:<br><textarea name="SessionPurpose" cols="30" rows="8" wrap="30" placeholder="目的を入力"></textarea></label>
                <label>反省:<br><textarea name="Reflection" cols="30" rows="8" wrap="30" placeholder="反省を入力"></textarea></label>
                <label>練習時間: <input type="time"name="Time"></label>
                <label>週数:<input type="text" name="WeekNumber"></label>
            </div>
            <div class="submit">    
                <input type="submit" value="記録する">
            </div>
        </form>
    </div>
</body>
</html>
