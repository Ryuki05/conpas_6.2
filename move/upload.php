<?php
    require_once ('../hanbaga.php');
    session_start();
    if (isset($_FILES["fileToUpload"])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $targetDirectory = "moves/"; // 保存先のディレクトリ
        $ImgName = $_FILES["fileToUpload"]["name"];
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0755, true); // ディレクトリが存在しない場合、作成
        }
 
        $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                header("Location: move.php");
                exit();
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
    <link rel="stylesheet" href="../css/move.css">
    <title>Movie編集</title>
</head>
<body>
    <form class="center" action="" method="POST" enctype="multipart/form-data">
        <div class="btn">
            <label class="upload" id="upload"><input  class="input_one" type="file" name="fileToUpload" id="fileToUpload" value="a"></label>
            <label id="upload"><input type="submit" value=""><img src="../images/upload.png"></label>
        <div>
    </form>
</body>
</html>