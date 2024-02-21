<?php
declare(strict_types=1);
session_start();
require_once ('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
$PlayerID = $_SESSION['PlayerID'];

// ユーザーデータを取得するクエリ
$pdo = connect();
$userStatement = $pdo->prepare('SELECT * FROM Record WHERE PlayerID = :PlayerID ORDER BY Match_Day DESC');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$Record = $userStatement->fetchAll(PDO::FETCH_ASSOC); // 全ての行を取得

// 日付でソートし、今日の日付を先頭に移動
usort($Record, function($a, $b) {
    return strtotime($b['Match_Day']) - strtotime($a['Match_Day']);
});

// 今日の日付が先頭に来るようにする
$today = date('Y-m-d');
foreach ($Record as $key => $session) {
    if ($session['Match_Day'] === $today) {
        $todaySession = $Record[$key];
        unset($Record[$key]);
        array_unshift($Record, $todaySession);
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/record.css">
    <title>Record</title>
</head>
<body>
    <main>
        <div class="s_07">
            <a class="btn" href="Record.php"><img src="../images/henshu.png" alt=""></a>
            <?php
            $previousDate = null; // 直前の日付を格納する変数を初期化
            foreach ($Record as $session):
                $currentDate = $session['Match_Day']; // 現在の日付を取得
                // 直前の日付と現在の日付が異なる場合、新しいアコーディオンを開始
                if ($previousDate !== $currentDate):
                    // 直前の日付を更新
                    $previousDate = $currentDate;
            ?>
            <!-- 新しいアコーディオンを開始 -->
            <div class="accordion_one">
                <div class="accordion_header">
                    <strong>大会日: <?= htmlspecialchars($session['Match_Day'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <strong>大会名: <?= htmlspecialchars($session['Match_Name'], ENT_QUOTES, 'UTF-8') ?></strong>
                    <i class="arrow_icon"></i> <!-- 矢印アイコン -->
                </div>
                <div class="accordion_inner">
                    <!-- 各日付ごとにデータを表示 -->
                    <?php foreach ($Record as $session): ?>
                        <?php if ($session['Match_Day'] === $currentDate): ?>
                            <div class="accordion_item">
                                <div class="accordion_content">
                                    <div class="accordion_inner coram">
                                        <strong>試合内容: </strong><?= escape($session['Match_Results']) ?><br>
                                        <strong>反省: </strong><?= escape($session['Reflect']) ?>
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
    <main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="../js/move.js"></script> 
</body>
</html>
