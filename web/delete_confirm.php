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
$data = $stmh -> fetch();

// try{
//     $sql = "delete from anken where id=".$id;
//     $stmt = $pdo -> query($sql);
//     $stmt -> execute();
// } catch (PDOException $e) { 
//     $msg = $e->getMessage();
// }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ削除</title>
</head>
<body>
    <h2>データ削除</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>
    <p>以下のデータを削除します</p>
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
                    <?php echo $data['anken_id'];?>
                </td>
            </tr>
            <tr>
                <th>件名</th>
                <td>
                    <?php echo $data['item_name'];?>
                </td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <form action="del-confirm.php" method="POST">
                        <button type="submit" name="btn" value = <?php $id; ?> >削除</button>
                    </form>
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