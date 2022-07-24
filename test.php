<?php

$name = $_POST['name'];
$mail = $_POST['mail'];
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

try{
    $sql = "SELECT * FROM account WHERE mail = :mail";
    $stmt = $pdo->prepare($sql);
    $stmt -> bindValue(':mail',$mail);
    $stmt -> execute();
    $member = $stmt->fetch();
    if ($member['mail'] === $mail) {
        $msg = 'すでに登録済みのメールアドレスです';
        $link = '<a href="index.php">戻る</a>';
    } else {

    $pdo = new PDO($dsn, $username, $password);
    $stmt = $pdo->prepare("INSERT INTO account (name, mail, pass )
    VALUES ( :name, :mail, :pass)");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $res = $stmt->execute();
}
} catch(PDOException $e) {
    print("登録にに失敗しました".$e->getMessage());
    die();
}

$pdo = null;

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
    <?php echo $name ?><br>
    <?php echo $mail ?><br>
    <?php echo $pass ?><br>
    <?php echo $msg ?><br>
    <?php echo $link ?>
</body>
</html>