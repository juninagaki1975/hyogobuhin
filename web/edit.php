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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>編集画面</title>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="#" class="navbar-brand mx-2">編集画面</a>
        <div class="navbar-nav col-md justify-content-end mx-2">
            <a class="nav-item nav-link active" href="index.php">ログアウト</a>
        </div>
    </nav>
    <form action="update_confirm.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <table>
            <tr>
                <th>No.</th>
                <td>
                    <label><?php echo $id; ?></label>
                </td>
            </tr>
            <tr>
                <th>案件番号</th>
                <td>
                    <input type="number" name="anken_id" value="<?php echo $edit['anken_id']; ?>">
                </td>
            </tr>
            <tr>
                <th>案件名</th>
                <td>
                    <input type="text" name="item_name" value="<?php echo $edit['item_name']; ?>">
                </td>
            </tr>
            <tr>
                <th>得意先</th>
                <td>
                    <input type="text" name="tokuisaki" value="<?php echo $edit['tokuisaki']; ?>">
                </td>
            </tr>
            <tr>
                <th>先方担当</th>
                <td>
                    <input type="text" name="senpoutantou" value="<?php echo $edit['senpoutantou']; ?>">
                </td>
            </tr>
            <tr>
                <th>EndUser</th>
                <td>
                    <input type="text" name="enduser" value="<?php echo $edit['enduser']; ?>">
                </td>
            </tr>
            <tr>
                <th>メーカー</th>
                <td>
                    <input type="text" name="maker" value="<?php echo $edit['maker']; ?>">
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
    <a href="main.php">タイトルに戻る</a>

</body>
</html>
