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
    $sql = "insert into anken values($id,$anken_id,'$item_name')";
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
    <title>登録内容確認</title>
</head>
<body>
    <h2>登録内容確認</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>

        <table>
            <tr>
                <th>No.</th>
                <td>
                    <?php echo $id;?>
                </td>
            </tr>
            <tr>
                <th>案件番号</th>
                <td>
                    <?php echo $anken_id;?>
                </td>
            </tr>
            <tr>
                <th>件名</th>
                <td>
                    <?php echo $item_name;?>
                </td>

            </tr>
        </table>

    
</body>
<footer>
    <br>
    <a href="index.php">タイトルに戻る</a>
    <hr>

</footer>
</html>
