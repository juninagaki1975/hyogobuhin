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
    <title>見積登録</title>
</head>
<body>
    <h2>見積登録</h2>
    <?php echo date("Y-m-d"); ?>
    <hr>
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
                <td><textarea name="part_remark" id="part_remark" cols="50" rows="10"></textarea>
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
    
</body>
<footer>
    <br>
    <a href="main.php">タイトルに戻る</a>
    <hr>

</footer>
</html>
