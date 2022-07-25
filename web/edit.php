<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$id = $_POST['btn'];
$sql = "SELECT * FROM anken WHERE id=".$id;
$stmh = $pdo -> query($sql);
$edit = $stmh -> fetch();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編集画面</title>
</head>
<body>
    <h2>編集画面</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>
    <form action="update_confirm.php" method="POST">
        <table>
            <tr>
                <th>No.</th>
                <td>
                    <label><?php echo $id; ?></label>
                    <!-- <input type="number" name="id" value="<?php echo $id; ?>"> -->
                </td>
            </tr>
            <tr>
                <th>案件番号</th>
                <td>
                    <input type="number" name="anken_id" value="<?php echo $edit['anken_id']; ?>">
                </td>
            </tr>
            <tr>
                <th>件名</th>
                <td>
                    <input type="text" name="item_name" value="<?php echo $edit['item_name']; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" value="更新確認へ">
                </td>
            </tr>
        </table>
    </form>

    <br>
    <hr>
    <a href="index.php">タイトルに戻る</a>

</body>
</html>
