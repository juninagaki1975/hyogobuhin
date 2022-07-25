<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$id = $_POST['btn'];
$sql = "SELECT * FROM anken WHERE id=".$id;
$stmh = $pdo -> query($sql);
$data = $stmh -> fetch();

try{
    $sql = "delete from anken where id=".$id;
    $stmt = $pdo -> query($sql);
    $stmt -> execute();
} catch (PDOException $e) { 
    $msg = $e->getMessage();
}

$to = 'juninagaki1975@gmail.com';
// $subject = '削除：'.$id;
// $message = "以下のデータが削除されました：\r\n ID： ".$id."\r\n 案件番号： ".$anken_id."\r\n 件名： ".$item_name;
$subject = '削除：';
$message = "以下のデータが削除されました：";
$headers = "From: juninagaki1975@gmail.com";
mb_send_mail($to, $subject, $message, $headers);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ削除</title>
</head>
<body>
    <h2>データ削除</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>
    <p>削除しました</p>
   
</body>
<footer>
    <br>
    <a href="index.php">タイトルに戻る</a>
    <hr>

</footer>
</html>
