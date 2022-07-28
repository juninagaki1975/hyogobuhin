<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

// 稻垣 2022.7.28
// ここはforとかで簡潔化の余地アリ
// $id = $_POST['id'];
// if (!isset($id)){
//     $id = "null";
// }
$anken_id = $_POST['anken_id'];
if (!isset($anken_id)){
    $anken_id = "null";
}
$item_name = $_POST['item_name'];
if (!isset($item_name)){
    $item_name = "null";
}
// $update_at = $_POST['update_at'];
// if (!isset($update_at)){
//     $update_at = "null";
// }
$update_at = date("Y-m-d");

$tokuisaki = $_POST['tokuisaki'];
if (!isset($tokuisaki)){
    $tokuisaki = "null";
}
$senpoutantou = $_POST['senpoutantou'];
if (!isset($senpoutantou)){
    $senpoutantou = "null";
}
$enduser = $_POST['enduser'];
if (!isset($enduser)){
    $enduser = "null";
}
$maker = $_POST['maker'];
if (!isset($maker)){
    $maker = "null";
}
$title = $_POST['title'];
if (!isset($title)){
    $title = "null";
}
$chassis = $_POST['chassis'];
if (!isset($chassis)){
    $chassis = "null";
}
$shipto = $_POST['shipto'];
if (!isset($shipto)){
    $shipto = "null";
}
$repname = $_POST['repname'];
if (!isset($repname)){
    $repname = "null";
}
$item_status = $_POST['item_status'];
if (!isset($item_status)){
    $item_status = "null";
}
try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

try{
    $sql = "insert into anken values(".$id.",".$anken_id.",'".$item_name."',".$update_at.",'".$tokuisaki."','".$senpoutantou."','".$enduser."','".$maker."','".$title."','".$chassis."','".$shipto."','".$repname."','".$item_status."')";

    $stmt = $pdo -> query($sql);
    $stmt -> execute();
} catch (PDOException $e) { 
    $msg = $e->getMessage();
}

unset($sql);
unset($stmt);

echo $sql;

try{
    $sql = "SELECT * FROM anken WHERE anken_id =".$anken_id;
    $stmt = $pdo -> query($sql);
    $stmt -> execute();
    $data = $stmt -> fetch();
} catch (PDOException $e) { 
    $msg = $e->getMessage();
}

echo $msg;


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>登録内容確認画面</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="#" class="navbar-brand mx-2">登録内容確認</a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="main.php">HOME</a>
        </div>
        <div class="navbar-nav col-md justify-content-end mx-2">
            <a class="nav-item nav-link active" href="index.php">ログアウト</a>
        </div>
    </nav>

    <div class="mx-3 my-3">
        <p>以下の内容で登録しました</p>
    </div>

    <div class="mx-3 my-3">
        <table>
            <?php 
            for ($i = 0; $i < 13; $i ++ ){
                echo "<tr>";
                echo "<th>";
                echo $arr[$i];
                echo "</th>";
                echo "<td>";
                echo $data[$i];
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
   
</body>
<div class="container">
    <footer class="py-3 my-4">
        <hr>
        <p class="text-center text-muted">&copy; 2022 株式会社兵庫部品</p>
  </footer>
</div>

</html>
