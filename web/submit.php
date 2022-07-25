<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$sql = "select count(id) from anken";
$stmt = $pdo -> query($sql);
$stmt -> execute();
$result = $stmt -> fetch();
$count = ++$result[0];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>
<body>
    <h2>新規登録</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>

    <form action="confirm.php" method="POST">
        <table>
            <tr>
                <th>No.</th>
                <td>
                    <label><?php echo $count; ?></label>
                </td>
            </tr>
            <tr>
                <th>案件番号</th>
                <td>
                    <input type="number" name="anken_id">
                </td>
            </tr>
            <tr>
                <th>件名</th>
                <td>
                    <input type="text" name="item_name">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" value="登録">
                </td>
            </tr>
        </table>
    </form>
    
</body>
<footer>
    <br>
    <a href="index.php">タイトルに戻る</a>
    <hr>

</footer>
</html>
