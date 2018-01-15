<?php
require_once "UserManager.php";
//var_dump($_SESSION['userid']);
if(!empty($_POST['userid']) && !empty($_POST['password'])){

	$userid = $_POST['userid'];
	$password = $_POST['password'];
	//書き込みの場合
	$regist = new UserManager();
	$regist->logincheck($userid,$password);
}
?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<title>ログイン画面</title>
		<link rel="stylesheet" href="sheet.css">
	</head>
	<body>
		<form method = "POST" action = "login.php">

			<p id="font">ユーザーID:<input type = "text" name = "userid" id="list"></p>
			<p id="font">パスワード:<input type = "text" name = "password" id="list"></p>
			<center>
				<p><input type="submit" value="ログイン" id="regist"></p>
			</center>
		</form>

	</body>
</html>
