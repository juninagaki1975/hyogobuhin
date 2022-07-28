<?php
$dsn = "mysql:host=us-cdbr-east-06.cleardb.net; dbname=heroku_53c1b1b9ce85b0e; charset=utf8";
$username = "bf87d40c92b415";
$password = "c2bf4cac";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e ) {
    $msg = $e->getMessage();
}

$arr = ['No.','案件番号','案件名','更新日','得意先','先方担当','EndUSer','メーカー','タイトル','車台番号','送り先','自社担当','進捗'];
$keys = ['id','anken_id','item_name','update_at','tokuisaki','senpoutantou','enduser','maker','title','chassis','shipto','repname','item_status'];

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
// echo $search;

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>メイン画面</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="#" class="navbar-brand mx-2">HOME</a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="submit.php">新規登録</a>
        </div>
        <div class="navbar-nav col-md justify-content-end mx-2">
            <a class="nav-item nav-link active" href="index.php">ログアウト</a>
        </div>
    </nav>
    <div class="container-fluid mx-2 px-2">
        <p>検索</p>
    </div>
</div>
<form action="search.php" method="POST">
        <table colspan="2" class="table-border" cellspacing="1" border="0" style="border-collapse: collapse">
            <tr>
                <th>期間</th>
                <td>
                    <input type="date" name="date_from">
                     〜 
                    <input type="date" name="date_to">
                </td>
            </tr>
            <tr><td><br></td></tr>
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
            </tr>


        </table>
        <td><p><input type="submit" name="search" value="検索"></p></td>
    </form>

    <hr>
    <table class="table table-striped" cellspacing="1" border="1" style="border-collapse: collapse">
        <tr>
            <th>確認</th>
            <?php 
                for ($i = 0; $i < 13; $i ++ ) {
                    echo "<th>";
                    echo $arr[$i]; 
                    echo "</th>";
                };?>
            <th>編集</th>
            <th>削除</th>
        </tr>
        <?php
            $i = 1;
            foreach ($stmh as $row) {
                echo '<tr>';
                echo '<td>';
                echo '<form action="inquiry.php" method="POST">';
                echo '<button type="submit" name="btn" value ="'.$row['id'].'">見積</button>';
                echo '</form>';
                echo '</td>';
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
                echo $row['update_at']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['tokuisaki']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['senpoutantou']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['enduser']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['maker']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['title']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['chassis']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['shipto']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['repname']."\n";
                echo '</td>';
                echo '<td>';
                echo $row['item_status']."\n";
                echo '</td>';

                echo '<td>';
                echo '<form action="edit.php" method="POST">';
                echo '<button type="submit" name="btn" value ="'.$row['id'].'">編集</button>';
                echo '</form>';
                echo '</td>';

                echo '<td>';
                echo '<form action="delete_confirm.php" method="POST">';
                echo '<button type="submit" name="btn" value ="'.$row['id'].'">削除</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                $i ++ ;
            }
        ?>
    
    </table>
    <br>
    <hr>



</body>

<div class="container">
    <footer class="py-3 my-4">
        <hr>
        <p class="text-center text-muted">&copy; 2022 株式会社兵庫部品</p>
  </footer>
</div>
</html>
