<?php
$dsn = "mysql:host=localhost; dbname=hyogobuhin; charset=utf8";
$username = "root";
$password = "Daoyuan1975_";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$sql = "select * from anken";
$sth = $pdo -> query($sql);
$aryColumn = $sth -> fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メイン画面</title>
</head>
<body>
    <h2>兵庫部品システム</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>
    <a href="search.php">検索</a>
    <a href="submit.php">新規登録</a>
    <a href="edit.php">編集</a>
    <hr>

</body>
</html>