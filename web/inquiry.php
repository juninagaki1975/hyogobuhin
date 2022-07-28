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

$arr = ['案件番号','品名','品番','備考','単価','数量','金額'];
$keys = ['anken_id','part_name','part_num','part_remark','unit_price','qty','total_price'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>見積登録</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="#" class="navbar-brand mx-2">見積登録</a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="main.php">HOME</a>
        </div>
        <div class="navbar-nav col-md justify-content-end mx-2">
            <a class="nav-item nav-link active" href="index.php">ログアウト</a>
        </div>
    </nav>

    <div class="mx-3 my-3">
    <form action="inquiry_confirm.php" method="POST">
        <!-- <input type="hidden" name=id value=<?php echo $count; ?>> -->
        <div>
            <p>見積データ</p>
        </div>
        <table colspan="2" class="table-border" cellspacing="1" border="0" style="border-collapse: collapse">
            <tr>
                <th><?php echo $arr[0];?></th>
                <td><input type="number" name="anken_id"></td>
            </tr>
            <tr>
                <th><?php echo $arr[1];?></th>
                <td><input type="text" name="part_name"></td>
            </tr>
            <tr>
                <th><?php echo $arr[2];?></th>
                <td><input type="text" name="part_num"></td>
            </tr>
            <tr>
                <th><?php echo $arr[3];?></th>
                <td><textarea name="part_remark" id="part_remark" cols="50" rows="3"></textarea>
            </tr>

            <tr>
                <th><?php echo $arr[4];?></th>
                <td><input type="number" name="unit_price"></td>
            </tr>

            <tr>
                <th><?php echo $arr[5];?></th>
                <td><input type="number" name="qty"></td>
            </tr>

            <tr>
                <th><?php echo $arr[6];?></th>
                <td><input type="number" name="total_price"></td>
            </tr>
            <tr><td><br></td></tr>
            <td><input type="submit" value="登録"></td>
        </table>
    </form>
    </div>
    
</body>
<div class="container">
    <footer class="py-3 my-4">
        <hr>
        <p class="text-center text-muted">&copy; 2022 株式会社兵庫部品</p>
  </footer>
</div>
</html>
