<?php
require_once "DBManager.php";
class UserManager{


	public function logincheck($userid,$password){

		$db = new DBManager();

		$resultArray2 = $db->getUserInfoTblByUserID($userid);

		if(empty($resultArray2)) {

			header("Location: ./login.php");

			}else {
				if ($this->passwordCheck($password,$resultArray2[0]->pass)){
					session_start();
					 $_SESSION["userid"] = $userid;
					 $_SESSION["username"] = $resultArray2[0]->username;

					session_regenerate_id();

					header("Location: ./login-ok.php");
				}else{
					header("Location: ./login.php");
			}
		}
	}

	public function registUser($userid,$password,$username){

		$db = new DBManager();

		//検索の場合
		$resultArray = $db->getUserInfoTblByUserID($userid);

		if (empty($resultArray)){
			$inPass = $this->passwordHash($password);
			$db->insertUserInfo($userid,$inPass,$username);

			header("Location: ./ok.php");
		}else{
			header("Location: ./feiled.php");
		}
	}


	public function passwordCheck($inPass,$hashPass){

		if(password_verify($inPass,$hashPass)) {
			return true;
		}else{
			return false;
		}
	}

	public function passwordHash($inPass){
		$pass = password_hash($inPass, PASSWORD_DEFAULT);
		return $pass;
	}
}
?>
