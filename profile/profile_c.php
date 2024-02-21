<?php
    require_once ('../hanbaga.php');
    session_start();
    if (isset($_FILES["fileToUpload"])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $targetDirectory = "../images/"; // 保存先のディレクトリ
        $ImgName = $_FILES["fileToUpload"]["name"];
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0755, true); // ディレクトリが存在しない場合、作成
        }
 
        $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                echo "ファイルが正常にアップロードされました。";
            } else {
                echo "ファイルのアップロード中にエラーが発生しました。";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/profile.css">
    <title>プロフィール編集</title>
</head>
<body>
    <main>
        <div class="">
            <div class="center" style="margin-top:3% !important">
                <form class="" action="" method="POST" enctype="multipart/form-data">
                    <label id="upload"><input class="input_one" type="file" name="fileToUpload" id="fileToUpload"></label>
                    <input type="submit" value="アップロード">
                </form>
            </div>
            <form class="center" action="profile_func.php" method="GET">
                <!-- PlayerID を隠しフィールドとして追加 -->
                <div class="center icon trans_img border pr_c">
                    <label>アイコン<input type="text" name="ImgName" placeholder="your img" value="<?=$ImgName?>"></label>
                    <label>ユーザー名<input type="text" name="Username" value=""></label>
                    <label>メールアドレス <input type="email" name="Email"></label>
                    <label>体重(KG)<input type="text" name="Weight"></label>
                    <label>身長(CM)<input type="text" name="Height"></label>
                    <label>筋肉量(KG)<input type="text" name="MuscleMass"></label>
                </div>
                <div class="submit">    
                    <input type="submit" value="更新">
                </div>
            </form>
        </div>
    </main>
</body>
</html>