<?php
require_once "UserManager.php";

if(!empty($_POST['userid']) && !empty($_POST['password']) && !empty($_POST['name'])){
		//どちらかで統一しよう！
		$userid = $_POST['userid'];
		$password = $_POST['password'];
		$username = $_POST['name'];
		//書き込みの場合
		$regist = new UserManager();
		$regist->registUser($userid,$password,$username);
}
?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<title>登録画面</title>
	</head>
	<body>
		<link href="sheet.css" rel="stylesheet" type="text/css">

		<form method = "POST" action = "registUser.php">
				<p id="font">ユーザーID:<input type = "text" name = "userid" id="list"></p>
				<p id="font">パスワード:<input type = "text" name = "password" id="list"></p>
				<p id="font">名前:<input type = "text" name = "name" id="list"></p>
				<center>
					<p><input type="submit" value="登録" id="regist"></p>
				</center>
		</form>

	</body>
</html>
