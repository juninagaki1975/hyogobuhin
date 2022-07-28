<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$sql = "SELECT name FROM users";
$stmt = $pdo -> query($sql);
$users = $stmt -> fetch();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>ログイン画面</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="#" class="navbar-brand mx-2">ログイン画面</a>
    </nav>
    <div class="container-fluid my-3">
     <form action="entrance.php" method="POST">
        <table>
            <tr>
                <th>ユーザーID</th>
                <td>
                    <input type="text" name="username" id="username" required>
                </td>
            </tr>
            <!-- <tr>
                <th>メールアドレス</th>
                <td>
                    <input type="email" name="email" id="email"  required>
                </td>
            </tr> -->
            <tr>
                <th>パスワード</th>
                <td>
                    <input type="password" name="pass" id="pass" required>
                </td>                
            </tr>
        </table>
        <p class="my-3">
            <input type="submit" value="決定">
        </p>
    </form>
    </div>
</body>
    <div class="container">
        <footer class="py-3 my-4">
            <hr>
            <p class="text-center text-muted">&copy; 2022 株式会社兵庫部品</p>
        </footer>
    </div>
</html>
