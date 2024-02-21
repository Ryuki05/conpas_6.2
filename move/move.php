<?php
    require_once ('../hanbaga.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/move.css">
    <title>Movie</title>
</head>
<body>
    <h1 class="text_center"><span class="span">M</span>ovie</h1>
    <div class="moves">
        <?php
        // 動画ファイルが保存されているディレクトリ
        $targetDirectory = "moves/";
        
        // ディレクトリ内の動画ファイルを取得
        $videoFiles = glob($targetDirectory . '*.mp4');
        
        // 動画ファイルが存在する場合、それぞれのファイルに対してビデオ要素を作成して表示
        if (!empty($videoFiles)) {
            foreach ($videoFiles as $videoFile) {
                echo '<video controls>';
                echo '<source src="' . $videoFile . '" type="video/mp4">';
                echo '</video>';
            }
        } else {
            echo '動画ファイルがありません。';
        }
        ?>
    </div>
    <form class="center" name="" action="upload.php" method="GET">
        <input type="hidden" name="PlayerID" value="<?= $PlayerID; ?>">
        <div>
            <label class="prasu">
                <input type="submit" name="upload" value="">
                <img src="../images/purasu.png">
            </label>
        </div>
    </form>
</body>
</html>
