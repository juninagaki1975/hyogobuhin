<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$username = $_POST['username'];
$pass = $_POST['pass'];

$sql = 'SELECT * FROM users WHERE name="'.$username.'"';
$stmt = $pdo -> query($sql);
$result = $stmt -> fetch();

if (!$result) {
    $msg = "未登録のユーザーです";
    $link = "<a href='login.php'>ログイン画面に戻る</a>";
} elseif ($result['name'] === $username) {
    if ($result['pass'] === $pass) {
    $msg = "ユーザー確認成功";
    $link = "<a href='main.php'>メイン画面へ</a>";     
    } else {
        $msg = "パスワードが違います";
        $link = "<a href='login.php'>ログイン画面に戻る</a>";     
    }
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
    <h2>兵庫部品システム<br>ログイン確認画面</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>
    <?php echo $msg; ?>
    <br><br>
    <?php echo $link; ?>
    <br>        
    <hr>
</body>
</html>
