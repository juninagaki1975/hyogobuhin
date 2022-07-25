<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

$id = $_POST['id'];
$anken_id = $_POST['anken_id'];
$item_name = $_POST['item_name'];

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

try{
    $sql = "INSERT INTO anken VALUES($id,$anken_id,'$item_name')";
    $stmt = $pdo -> query($sql);
    $stmt -> execute();
} catch (PDOException $e) { 
    $msg = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ登録</title>
</head>
<body>
    <h2>データ登録</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>
    <p>登録しました</p>

</body>
<footer>
    <br>
    <a href="index.php">タイトルに戻る</a>
    <hr>

</footer>
</html>
