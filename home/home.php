<?php
declare(strict_types=1);
session_start();
require_once ('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
// $_SESSION['PlayerID'] = $_GET['PlayerID'];
$PlayerID = $_SESSION['PlayerID'];

// ユーザーデータを取得するクエリ
$pdo = connect();  // この行を追加して、PDOオブジェクトを取得
$userStatement = $pdo->prepare('SELECT * FROM players WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$userRow = $userStatement->fetch(PDO::FETCH_ASSOC);

//profile
// 各パラメータを取得してから表示
$ImgName = isset($userRow['ImgName']) ? htmlspecialchars($userRow['ImgName'], ENT_QUOTES, 'UTF-8') : '';
$Username = isset($userRow['Username']) ? htmlspecialchars($userRow['Username'], ENT_QUOTES, 'UTF-8') : 'ユーザー名が見つかりませんでした';
$Email = isset($userRow['Email']) ? htmlspecialchars($userRow['Email'], ENT_QUOTES, 'UTF-8') : '';
$Weight = isset($userRow['Weight']) ? htmlspecialchars($userRow['Weight'], ENT_QUOTES, 'UTF-8') : '';
$Height = isset($userRow['Height']) ? htmlspecialchars($userRow['Height'], ENT_QUOTES, 'UTF-8') : '';
$MuscleMass = isset($userRow['MuscleMass']) ? htmlspecialchars($userRow['MuscleMass'], ENT_QUOTES, 'UTF-8') : '';
$BMI = isset($userRow['BMI']) ? htmlspecialchars($userRow['BMI'], ENT_QUOTES, 'UTF-8') : '';

// To_Day_training
// ユーザーデータを取得するクエリ
$today = date("Y-m-d");
$userStatement = $pdo->prepare('SELECT * FROM trainingsessions WHERE PlayerID = :PlayerID AND SessionDate = :today');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->bindParam(':today', $today, PDO::PARAM_STR);
$userStatement->execute();
$trainingSessions = $userStatement->fetchAll(PDO::FETCH_ASSOC);

//Record
// ユーザーデータを取得するクエリ
$today = date("Y-m-d");
$userStatement = $pdo->prepare('SELECT * FROM Record WHERE PlayerID = :PlayerID AND Match_Day = :today');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->bindParam(':today', $today, PDO::PARAM_STR);
$userStatement->execute();
$Record = $userStatement->fetchAll(PDO::FETCH_ASSOC); // その日の試合記録のみを取得

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Document</title>
</head>
<body>
    <main>
        <section class="profile"><!-- プロフィール -->
            <div>
                <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                <p class="section_title"><span class="span"><?= substr($Username, 0, 1); ?></span><?= substr($Username, 1); ?></p>
                <div class="center icon trans_img">
                    <img src="../images/<?= $ImgName; ?>" alt="アイコン">
                </div>
                <p class="player_id">選手ID:<?= $PlayerID; ?></p>
                <div class="more_btn_p">
                    <p class="border"></p>
                    <form class="center" name="" action="../profile/profile.php" method="GET">
                        <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                        <label class="my_profile"><input class="trans" type="submit" name="profile" value="My Profile >"></label>
                    </form>
                </div>
            </div>
        </section>
        <section class="to_day_training"><!-- その日の練習 -->
            <div>
                <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                <p class="section_title"><span><span class="span">T</span>o <span class="span">D</span>ay <span class="span">T</span>raining</span></p>
                <?php foreach ($trainingSessions as $session): ?>
                <div class="overflow memo">
                    <p><?= htmlspecialchars(date('Y年m月d日', strtotime($session['SessionDate'])), ENT_QUOTES, 'UTF-8') ?></p>
                    <p><?= $exerciseContent = "練習内容\n";?></p>
                    <p><?= $exerciseContent = htmlspecialchars($session['SessionPurpose'], ENT_QUOTES, 'UTF-8');?></p>
                </div>
                <?php endforeach; ?>
                <div class="more_btn_t">
                    <p class="border"></p>
                    <form class="center" name="" action="../To_Day_training/look.php" method="GET">
                        <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                        <label class="my_profile"><input class="trans" type="submit" name="profile" value="More >"></label>
                    </form>
                </div>
            </div>
            
        </section>
        <section class="record"><!-- 試合記録 -->
            <div>
                <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                <p class="section_title"><span><span class="span">R</span>ecord</span></p>
                <?php foreach ($Record as $session): ?>
                <div class="overflow">
                    <p><?= htmlspecialchars(date('Y年m月d日', strtotime($session['Match_Day'])), ENT_QUOTES, 'UTF-8') ?></p>
                    <p><?= $exerciseContent = htmlspecialchars($session['Match_Name'], ENT_QUOTES, 'UTF-8');?></p>
                    <p><?= $exerciseContent = htmlspecialchars($session['Match_Results'], ENT_QUOTES, 'UTF-8');?></p>
                </div>
                <?php endforeach; ?>
                <div class="more_btn_r">
                    <p class="border"></p>
                    <form class="center" name="" action="../Record/Record_look.php" method="GET">
                        <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                        <label class="my_profile"><input class="trans" type="submit" name="profile" value="More >"></label>
                    </form>
                </div>
            </div>
        </section>
        <section class="others"><!--その他-->
            <div>
                <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
                <form name="" action="../Condition/Condition.php" method="GET">
                    <input class="trans" type="submit" name="profile" value=">">
                    <div class="condtion other_img">
                        <img src="../images/condtion.png">
                    </div>
                    <p><span class="span">C</span>ondition</p>
                </form>
                <form name="" action="../note/addition.php" method="GET">
                    <input class="trans" type="submit" name="profile" value=">">
                    <div class="note other_img">
                        <img src="../images/note.png">
                    </div>
                    <p><span class="span">N</span>ote</p>
                </form>
                <form name="" action="../move/move.php" method="GET">
                    <input class="trans" type="submit" name="profile" value=">">
                    <div class="move other_img">
                        <img src="../images/move.png">
                    </div>
                    <p><span class="span">M</span>ovie</p>
                </form>
            </div>
        </section>
    </main>
    
</body>
</html>
