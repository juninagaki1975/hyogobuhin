<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

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
