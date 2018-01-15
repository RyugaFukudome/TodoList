<!DOCTYPE html>
<html lang=ja>
<head>
<meta charset="utf-8">
<title>ログイン完了画面</title>
</head>
<body>
<link href="sheet.css" rel="stylesheet" type="text/css">
<form method = "POST" action = "logout.php">

        <p style="font-size: 50px; text-align: center;">
            <?php
                session_start();
                if(isset($_SESSION["userid"]) && isset($_SESSION["username"])){
                    echo "ようこそ". $_SESSION["username"] . "さん";
                }else{
                    header("Location: login.php");
                }
            ?>
        </p>
<center>
    <input type="submit" value="ログアウト" id="logout">
</center>
</form>
</body>
</html>
