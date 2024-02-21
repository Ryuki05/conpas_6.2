<?php
session_start();
require_once('../func.php');
require_once ('../hanbaga.php');

// PlayerIDのGETパラメータを取得
$PlayerID = $_SESSION['PlayerID'];

// ユーザーデータを取得するクエリ
$pdo = connect();
$userStatement = $pdo->prepare('SELECT * FROM Players WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$userRow = $userStatement->fetch(PDO::FETCH_ASSOC);

// BMIを計算
$Weight = isset($userRow['Weight']) ? htmlspecialchars($userRow['Weight'], ENT_QUOTES, 'UTF-8') : '';
$Height = isset($userRow['Height']) ? htmlspecialchars($userRow['Height'], ENT_QUOTES, 'UTF-8') : '';
$MuscleMass = isset($userRow['MuscleMass']) ? htmlspecialchars($userRow['MuscleMass'], ENT_QUOTES, 'UTF-8') : '';
$BMI = calculateBMI($Weight, $Height);

// BMIを計算する関数
function calculateBMI($weight, $height)
{
    if ($weight > 0 && $height > 0) {
        return $weight / (($height / 100) * ($height / 100));
    } else {
        return null;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/Condition.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <title>Condition</title>
</head>

<body>
    <div>
        <h1 class="text_center"><span class="span">C</span>ondition</h1>
        <form action="Condition.php" method="POST">
            <div class="input">
                <label for="Weight"><span class="span">W</span>eight (kg):</label>
                <input type="text" id="Weight" name="Weight" value="<?php echo $Weight; ?>" required>
                <label for="Height"><span class="span">H</span>eight (cm):</label>
                <input type="text" id="Height" name="Height" value="<?php echo $Height; ?>" required>
                <label for="MuscleMass"><span class="span">M</span>uscle <span class="span">M</span>ass (kg):</label>
                <input type="text" id="MuscleMass" name="MuscleMass" value="<?php echo $MuscleMass; ?>" required>
                <input type="submit" value="記録する">
            </div>
        </form>
    </div>
</body>

</html>
