<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
    <h2>新規登録</h2>
    <form action="register.php" method="POST">
        <div>
            名前<br>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            メールアドレス<br>
            <input type="email" name="mail" id="mail" required>        
        </div>
        <div>
            パスワード<br>
            <input type="password" name="pass" id="pass"required>
        </div>
        <br>
        <input type="submit" value="新規登録">
    </form>
    <p>すでに新規登録済みの方はこちらへ</p>
    <a href="login.php">ログイン</a>
    
</body>
</html>