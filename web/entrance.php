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
    $link = "<a href='index.php'>ログイン画面に戻る</a>";
} elseif ($result['name'] === $username) {
    if ($result['pass'] === $pass) {
    $msg = "ユーザー確認成功";
    $link = "<a href='main.php'>メイン画面へ</a>";     
    } else {
        $msg = "パスワードが違います";
        $link = "<a href='index.php'>ログイン画面に戻る</a>";     
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>ログイン確認画面</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="#" class="navbar-brand mx-2">ログイン確認</a>
    </nav>
    <div class="my-3 mx-3">
        <?php echo $msg; ?>
        <br><br>
        <?php echo $link; ?>
        <br>        
    </div>
</body>
<div class="container">
    <footer class="py-3 my-4">
        <hr>
        <p class="text-center text-muted">&copy; 2022 株式会社兵庫部品</p>
  </footer>
</div>
</html>
