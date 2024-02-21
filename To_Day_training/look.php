<?php
declare(strict_types=1);
session_start();
require_once ('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
$PlayerID = $_SESSION['PlayerID'];
// ユーザーデータを取得するクエリ
$pdo = connect();
$userStatement = $pdo->prepare('SELECT * FROM trainingsessions WHERE PlayerID = :PlayerID ORDER BY SessionDate DESC');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$trainingSessions = $userStatement->fetchAll(PDO::FETCH_ASSOC); // 全ての行を取得

// 今日の日付を取得
$todayDate = date('Y-m-d');

// 今日の日付を配列の先頭に移動する
$sortedTrainingSessions = [];
foreach ($trainingSessions as $session) {
    if ($session['SessionDate'] === $todayDate) {
        array_unshift($sortedTrainingSessions, $session);
    } else {
        $sortedTrainingSessions[] = $session;
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/today.css">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <title>Record</title>
</head>
<body>
    <!-- レコードの表示 -->
    <main>
        <div class="s_07">
            <a class="btn" href="To_Day_training.php"><img src="../images/henshu.png" alt=""></a>
            <?php
            $previousDate = null; // 直前の日付を格納する変数を初期化
            foreach ($sortedTrainingSessions as $session):
                $currentDate = $session['SessionDate']; // 現在の日付を取得
                // 直前の日付と現在の日付が異なる場合、新しいアコーディオンを開始
                if ($previousDate !== $currentDate):
                    // 直前の日付を更新
                    $previousDate = $currentDate;
            ?>
            <!-- 新しいアコーディオンを開始 -->
            <div class="accordion_one">
                <div class="accordion_header">
                    <strong>練習日: <?= htmlspecialchars($session['SessionDate'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <i class="arrow_icon"></i> <!-- 矢印アイコン -->
                </div>
                <div class="accordion_inner">
                    <!-- 各日付ごとにデータを表示 -->
                    <?php foreach ($sortedTrainingSessions as $session): ?>
                        <?php if ($session['SessionDate'] === $currentDate): ?>
                            <div class="accordion_item">
                                <div class="accordion_content">
                                    <div class="accordion_inner coram">
                                        <strong>強度:<?= escape($session['Intensity']) ?></strong>
                                        <strong>練習内容/目的:</strong><?= escape($session['SessionPurpose']) ?>
                                        <strong>反省: </strong><?= escape($session['Reflection']) ?>
                                        <strong>練習時間:<?= escape($session['Time']) ?></strong>
                                        <strong>週数:<?= escape($session['WeekNumber']) ?></strong>
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
