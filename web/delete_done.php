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

try{
    $sql = "delete from anken where id=".$id;
    $stmt = $pdo -> query($sql);
    $stmt -> execute();
} catch (PDOException $e) { 
    $msg = $e->getMessage();
}

$to = "juninagaki1975@gmail.com";
$mail_text = "下記のデータが削除されました<br/>ID: ".$data['id']."<br/>案件番号:　".$data['anken_id']."<br/>件名: ".$data['item_name'];

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $_ENV['TRUSTIFI_URL'] . "/api/i/v1/email",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>"{\"recipients\":[{\"email\":\"$to\"}],\"title\":\"Title\",\"html\":\"$mail_text\"}",
    CURLOPT_HTTPHEADER => array(
        "x-trustifi-key: " . $_ENV['TRUSTIFI_KEY'],
        "x-trustifi-secret: " . $_ENV['TRUSTIFI_SECRET'],
        "content-type: application/json"
    )
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}

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
    <p>削除しました</p>
   
</body>
<footer>
    <br>
    <a href="index.php">タイトルに戻る</a>
    <hr>

</footer>
</html>
