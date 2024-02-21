<?php
declare(strict_types=1);
require_once('../func.php');
require_once('../hanbaga.php');
session_start();
$PlayerID = $_SESSION['PlayerID'];
// ユーザーデータを取得するクエリ
$pdo = connect();  // この行を追加して、PDOオブジェクトを取得
$userStatement = $pdo->prepare('SELECT * FROM Record WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();

// フォームデータが正しく送信されているかを確認し、それぞれの変数に代入する
$NoteContent = isset($_GET['NoteContent']) ? $_GET['NoteContent'] : '';
$Category = isset($_GET['Category']) ? $_GET['Category'] : '';
$Record_Date = isset($_GET['Record_Date']) ? $_GET['Record_Date'] : '';

// Record_Date フィールドが null でないことを確認し、null の場合はデフォルト値を設定する
if (empty($Record_Date)) {
    $Record_Date = date('Y-m-d'); // デフォルト値を現在の日付に設定
}

// フォームが空でない場合のみデータベースに追加
if (!empty($NoteContent) && !empty($Category) && !empty($Record_Date)) {
    $statement = $pdo->prepare('INSERT INTO trainingnotes(`NoteContent`, `Category`, `Record_Date`) VALUES(:NoteContent, :Category, :Record_Date)');
    $statement->bindValue(':NoteContent', $NoteContent, PDO::PARAM_STR);
    $statement->bindValue(':Category', $Category, PDO::PARAM_STR);
    $statement->bindValue(':Record_Date', $Record_Date, PDO::PARAM_STR);
    $statement->execute();
    header('Location: note.php');
}

//trainingnotesの呼び出し
$statement = $pdo->prepare('SELECT NoteContent, Category, Record_Date FROM trainingnotes');
$statement->execute();
$notes = $statement->fetchAll(PDO::FETCH_ASSOC); // データを取得

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/note.css">
    <title>note</title>
</head>
<body>
    <h1 class="text_center"><span class="span">N</span>ote</h1>
    <main>
        <div class="s_07">
            <a class="btn" href="addition.php"><img src="../images/henshu.png" alt=""></a>
            <?php
            $previousDate = null; // 直前の日付を格納する変数を初期化
            foreach ($notes as $note):
                $currentDate = $note['Record_Date']; // 現在の日付を取得
                // 直前の日付と現在の日付が異なる場合、新しいアコーディオンを開始
                if ($previousDate !== $currentDate):
                    // 直前の日付を更新
                    $previousDate = $currentDate;
            ?>
            <!-- 新しいアコーディオンを開始 -->
            <div class="accordion_one">
                <div class="accordion_header">
                    <strong>記録日: <?= escape($currentDate) ?></strong>
                    <i class="arrow_icon"></i> <!-- 矢印アイコン -->
                </div>
                <div class="accordion_inner">
                    <!-- 各日付ごとにデータを表示 -->
                    <?php foreach ($notes as $noteItem): ?>
                        <?php if ($noteItem['Record_Date'] === $currentDate): ?>
                            <div class="accordion_item">
                                <div class="accordion_header">
                                    <div class="i_box"><i class="one_i"></i></div>
                                </div>
                                <div class="accordion_content">
                                    <div class="accordion_header"><strong>ファイル名: <?= escape($noteItem['Category']) ?></strong><div class="i_box"><i class="one_i"></i></div></div>
                                    <div class="accordion_inner">
                                        <strong>内容: </strong><?= escape($noteItem['NoteContent']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div> <!-- アコーディオンの終了 -->
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../js/move.js"></script>
</body>
</html>
