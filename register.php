<?php
$name = $_POST['name'];
$mail = $_POST['mail'];
$pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);
$dsn = "mysql:host=localhost; dbname=hyogobuhin; charset=utf8";
$username = "root";
$password = "Daoyuan1975_";

try{
    $dbn = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$sql = "SELECT * FROM account WHERE mail = :mail";
$stmt = $dbn->prepare($sql);
$stmt -> bindValue(':mail',$mail);
$stmt -> execute();
$member = $stmt->fetch();

if ($member['mail'] === $mail) {
    $msg = 'すでに登録済みのメールアドレスです';
    header("Location: ./login.html");
    // $link = '<a href="sigup.php">戻る</a>';
 } else {
      $sql = "INSERT INTO account(name, mail, pass) VALUES (:name, :mail, :pass)";
     $stmt = $dbh -> prepare($sql);
     $stmt -> bindValue(':name',$name);
     $stmt -> bindValue(':mail',$mail);
     $stmt -> bindValue(':pass',$pass);
     $stmt -> execute();
     $msg = '登録完了';
     $link = '<a href="login.php">ログイン</a>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>
    テスト
</body>
</html>