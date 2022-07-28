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

$arr = ['No.','案件番号','案件名','更新日','得意先','先方担当','EndUSer','メーカー','タイトル','車台番号','送り先','自社担当','進捗'];
$keys = ['id','anken_id','item_name','update_at','tokuisaki','senpoutantou','enduser','maker','title','chassis','shipto','repname','item_status'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>新規登録</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="#" class="navbar-brand mx-2">新規登録</a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="main.php">HOME</a>
            <a class="nav-item nav-link active" href="search.php">検索</a>
        </div>
        <div class="navbar-nav col-md justify-content-end mx-2">
            <a class="nav-item nav-link active" href="index.php">ログアウト</a>
        </div>
    </nav>

    <form action="confirm.php" method="POST">
        <!-- <input type="hidden" name=id value=<?php echo $count; ?>> -->
        <div class="mx-3 my-3">
            <p>案件データ</p>
        </div>
        <div class="mx-3 my-3">
        <table colspan="2" class="table-border" cellspacing="1" border="0" style="border-collapse: collapse">
            <tr>
                <th><?php echo $arr[1];?></th>
                <td><input type="number" name="anken_id"></td>
                <th><?php echo $arr[2];?></th>
                <td><input type="text" name="item_name"></td>
            </tr>
            <!-- <tr><td><br></td></tr> -->
            <tr>
                <th><?php echo $arr[4];?></th>
                <td><input type="text" name="tokuisaki"></td>
                <th><?php echo $arr[5];?></th>
                <td><input type="text" name="senpoutantou"></td>
            </tr>
            <tr>
                <th><?php echo $arr[6];?></th>
                <td><input type="text" name="enduser"></td>
            </tr>
            <!-- <tr><td><br></td></tr> -->
            <tr>
                <th><?php echo $arr[7];?></th>
                <td><input type="text" name="chassis"></td>
                <th><?php echo $arr[8];?></th>
                <td><input type="text" name="shipto"></td>
            </tr>
            <!-- <tr><td><br></td></tr> -->
            <tr>
                <th><?php echo $arr[9];?></th>
                <td><input type="text" name="repname"></td>
            </tr>
            <tr>
                <th><?php echo $arr[10];?></th>
                <td><input type="text" name="item_status"></td>
            </tr>
            <tr>
                <th><?php echo $arr[11];?></th>
                <td>
                    <select name="repname" id="repname">
                        <option value=""></option>
                        <option value="hotta">堀田</option>
                    </select>
                </td>
                <th><?php echo $arr[12];?></th>
                <td>
                        <select name="item_status" id="item_status">
                            <option value=""></option>
                            <option value="inquiry">見積中</option>
                            <option value="inq_done">見積済</option>
                            <option value="inq_again">再見積済</option>
                            <option value="order">注文依頼</option>
                            <option value="commit">注文確定</option>
                            <option value="shipping">発送中</option>
                            <option value="complete">完了</option>
                        </select>
                    </td>
                    <tr><td><br></td></tr>
                        <td><input type="submit" value="登録"></td>

                </table>
        </div>
    </form>
</body>
<div class="container">
    <footer class="py-3 my-4">
        <hr>
        <p class="text-center text-muted">&copy; 2022 株式会社兵庫部品</p>
  </footer>
</div>
</html>
