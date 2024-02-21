<?php
session_start();
require_once('../func.php');
require_once('../hanbaga.php');

// PlayerIDがセットされていることを確認
if (!isset($_SESSION['PlayerID'])) {
    // リダイレクトなど、エラーハンドリングを行う
    exit("PlayerID is not set");
}

$PlayerID = $_SESSION['PlayerID'];

// ユーザーデータを取得するクエリ
$pdo = connect();
$userStatement = $pdo->prepare('SELECT * FROM Players WHERE PlayerID = :PlayerID');
$userStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$userStatement->execute();
$userRow = $userStatement->fetch(PDO::FETCH_ASSOC);

// Conditionテーブルのデータを取得するクエリ
$conditionStatement = $pdo->prepare('SELECT * FROM `Condition` WHERE PlayerID = :PlayerID ORDER BY Day ASC');
$conditionStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
$conditionStatement->execute();
$conditionRows = $conditionStatement->fetchAll(PDO::FETCH_ASSOC);

// フォームが送信された場合
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 編集フォームから送信されたデータを取得
    $Weight = $_POST['Weight'];
    $Height = $_POST['Height'];
    $MuscleMass = $_POST['MuscleMass'];
    $BMI = calculateBMI($Weight, $Height);

    // Conditionテーブルにデータを挿入
    $insertStatement = $pdo->prepare('INSERT INTO `Condition` (PlayerID, Weight, Height, MuscleMass, BMI, Day) VALUES (:PlayerID, :Weight, :Height, :MuscleMass, :BMI, NOW())');
    $insertStatement->bindParam(':PlayerID', $PlayerID, PDO::PARAM_INT);
    $insertStatement->bindParam(':Weight', $Weight);
    $insertStatement->bindParam(':Height', $Height);
    $insertStatement->bindParam(':MuscleMass', $MuscleMass);
    $insertStatement->bindParam(':BMI', $BMI);
    $insertStatement->execute();

    // リダイレクト
    header("Location: condition.php");
    exit();
}

// データを格納する配列を初期化
$weightData = [];
$heightData = [];
$muscleMassData = [];
$bmiData = [];
$days = [];

// 各データを配列に格納
foreach ($conditionRows as $row) {
    $weightData[] = $row['Weight'];
    $heightData[] = $row['Height'];
    $muscleMassData[] = $row['MuscleMass'];
    $bmiData[] = $row['BMI'];
    $days[] = date('Y-m-d', strtotime($row['Day'])); // 日付を取得してフォーマット
}

// BMIを計算する関数
function calculateBMI($weight, $height)
{
    // センチメートルからメートルに変換
    $heightInMeters = $height / 100;
    if ($weight > 0 && $heightInMeters > 0) {
        return $weight / ($heightInMeters * $heightInMeters);
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
    <title>Condition</title>
    <link rel="stylesheet" href="../css/hanbaga.css">
    <link rel="stylesheet" href="../css/Condition.css">
</head>

<body>
    <h1 class="text_center"><span class="span">C</span>ondition</h1>
    <div>
        <a class="btn" href="edit_condition.php"><img src="../images/henshu.png" alt=""></a>
    </div>
    <div class="chart_container">
        <canvas id="weightChart"></canvas>
        <canvas id="heightChart"></canvas>
        <canvas id="muscleMassChart"></canvas>
        <canvas id="bmiChart"></canvas>
    </div>
    <script>
        // PHPから渡されたデータをJavaScriptに直接出力する
        var weightData = <?php echo json_encode($weightData); ?>;
        var heightData = <?php echo json_encode($heightData); ?>;
        var muscleMassData = <?php echo json_encode($muscleMassData); ?>;
        var bmiData = <?php echo json_encode($bmiData); ?>;
        var days = <?php echo json_encode($days); ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/chart_script.js"></script>
</body>

</html>
