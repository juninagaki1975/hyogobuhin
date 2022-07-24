<?php
$name = $_POST['name'];
$pass = $_POST['pass'];
// $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);
$dsn = "mysql:host=localhost; dbname=hyogobuhin; charset=utf8";
$username = "root";
$password = "Daoyuan1975_";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$sql = "SELECT * FROM account WHERE name = :name";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(':name',$name);
$stmt -> execute();
$member = $stmt->fetch();
if ($member['name'] === $name) {
    $msg = 'すでに登録済みの名前です';
    $link = '<a href="login.html">ログイン画面に戻る</a>';
    }
else {
    $msg = "ログイン完了";
    $link = '<a href="login.html">ログイン画面に戻る</a>';
    header("Location: ./index.html");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン確認画面</title>
</head>
<body>
    <?php echo $msg; ?>
    <br>
    <?php echo $link; ?>
    
</body>
</html>    
