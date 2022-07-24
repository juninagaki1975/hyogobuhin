<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$sql = "show columns from anken";
$stmh = $pdo -> prepare($sql);
$stmh -> execute();
while($row = $stmh -> fetch(PDO::FETCH_ASSOC)){
    $rows[] = $row;
}
$arr = ['ID','案件番号','件名'];
$keys = ['id','anken_id','item_name'];

// キーワード検索
$key_id = $_POST['id'];
$key_anken_id = $_POST['anken_id'];
$key_item_name = $_POST['item_name'];

$val = $_POST;
$i = 0;
$ischk = array();
foreach ($keys as $key){
    if (empty($val[$keys[$i]])){
        // echo $keys[$i]."は空です";
        $ischk[$i] = 0;
    } else {
        $ischk[$i] = 1;
    }
    $i ++ ;
}
unset($i);


if (array_sum($ischk)===0){
    $search = "SELECT * FROM anken";
}


$i = 0;
if (array_sum($ischk)===1){
    foreach($ischk as $is){
        if($is == 1){
            if (gettype($val[$keys[$i]]) == "string"){
                $search = "SELECT * FROM anken where ".$keys[$i]."='".$val[$keys[$i]]."'";
            } else {
                $search = "SELECT * FROM anken where ".$keys[$i]."=".$val[$keys[$i]];
            }
        }
        $i ++ ;
    }
}
unset($i);

$i = 0;
$where = array();
if (array_sum($ischk) > 1){
    foreach($ischk as $is){
        if($is == 1){
            if (gettype($val[$keys[$i]]) == "string"){
                $where[] = $keys[$i]."='".$val[$keys[$i]]."'";
            } else {
                $where[] = $keys[$i]."=".$val[$keys[$i]];
            }
        }
        $i ++ ;
    }
    $search = "SELECT * FROM anken WHERE ".implode(" AND ",$where);
    // $search = "SELECT * FROM anken WHERE ".$where;
}
echo $search;

$sql = $search;
$stmh = $pdo -> prepare($sql);
$stmh -> execute();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索</title>
</head>
<body>
    <h2>検索</h2>
    <br>
    <form action="search.php" method="POST">
        <table class="table-border" cellspacing="1" border="0" style="border-collapse: collapse">
            <tr>
                <th><?php echo $arr[0] ;?></th>
                <th><?php echo $arr[1] ;?></th>
                <th><?php echo $arr[2] ;?></th>
            </tr>
            <tr>
                <td><input type="number" name="id"></td>
                <td><input type="number" name="anken_id"></td>
                <td><input type="text" name="item_name"></td>
            </tr>
            <tr>
                <td><p><input type="submit" name="search" value="検索"></p></td>
            </tr>
        </table>
    </form>
    <hr>
    <table class="table-border" cellspacing="1" border="1" style="border-collapse: collapse">
        <tr>
            <th><?php echo $arr[0] ;?></th>
            <th><?php echo $arr[1] ;?></th>
            <th><?php echo $arr[2] ;?></th>
            <th>編集</th>
        </tr>
        <?php
            $i = 1;
            foreach ($stmh as $row) {
                echo '<tr>';
                echo '<td>';
                echo $row['id']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['anken_id']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['item_name']."\n";
                echo '</td>';
                echo '<td>';
                echo '<form action="edit.php" method="POST">';
                echo '<button type="submit" name ="'.$i.'">編集</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                $i ++ ;
            }
        ?>
    
    </table>
    <br>
    <hr>
    <a href="index.php">タイトルに戻る</a>
</body>
</html>
