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

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>データ削除</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="#" class="navbar-brand mx-2">案件削除</a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="main.php">HOME</a>
        </div>
        <div class="navbar-nav col-md justify-content-end mx-2">
            <a class="nav-item nav-link active" href="index.php">ログアウト</a>
        </div>
    </nav>

    <div class="mx-3 my-3">
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
                <th>案件名</th>
                <td>
                    <?php echo $data['item_name'];?>
                </td>
            </tr>
            <tr>
                <th>得意先</th>
                <td>
                    <?php echo $data['tokuisaki'];?>
                </td>
            </tr>
            <tr>
                <th>先方担当</th>
                <td>
                    <?php echo $data['senpoutantou'];?>
                </td>
            </tr>
            <tr>
                <th>EndUser</th>
                <td>
                    <?php echo $data['enduser'];?>
                </td>
            </tr>
            <tr>
                <th>メーカー</th>
                <td>
                    <?php echo $data['maker'];?>
                </td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>
                    <?php echo $data['title'];?>
                </td>
            </tr>
            <tr>
                <th>車台番号</th>
                <td>
                    <?php echo $data['chassis'];?>
                </td>
            </tr>
            <tr>
                <th>送り先</th>
                <td>
                    <?php echo $data['shipto'];?>
                </td>
            </tr>
            <tr>
                <th>自社担当</th>
                <td>
                    <?php echo $data['repname'];?>
                </td>
            </tr>
            <tr>
                <th>進捗</th>
                <td>
                    <?php echo $data['item_status'];?>
                </td>
            </tr>

            <tr><td><br></td></tr>
            <tr>
                <td>
                    <form action="delete_done.php" method="POST">
                        <button type="submit" name="btn" value = <?php echo $id; ?> >決定</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</body>

<div class="container">
    <footer class="py-3 my-4">
        <hr>
        <p class="text-center text-muted">&copy; 2022 株式会社兵庫部品</p>
  </footer>
</div>
</html>
