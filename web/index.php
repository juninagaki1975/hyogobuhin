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
echo $users['name'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
    <h2>兵庫部品システム<br>ログイン画面</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>
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
        <p>
            <input type="submit" value="決定">
        </p>
    </form>
    <hr>
</body>
</html>
