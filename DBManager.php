<?php
//テーブル用のクラスを読み込む
require_once "UserInfoTblDT.php";

class DBLoginInfo{
    public $userid = "testuser";
    public $password = "asojuku";
    public $dbhost = "localhost";
    public $dbname = "nikkidb";
}

class DBManager{

private $myPdo;

    //接続のメソッド
    public function dbConnect(){
        try{
            $info = new DBLoginInfo();
            $this->myPdo = new PDO('mysql:host=' . $info->dbhost . ';dbname=' . $info->dbname . ';charset=utf8', $info->userid, $info->password, array(PDO::ATTR_EMULATE_PREPARES => false));
        }catch(PDOException $e) {
            print('データベース接続失敗。'.$e->getMessage());
            throw $e;
        }
    }

    //切断のメソッド
    public function dbDisconnect(){
        unset($myPdo);
    }


    //検索のメソッド
    public function getUserInfoTblByUserID($getid){
        try{
            $this->dbConnect();
            $stmt = $this->myPdo->prepare('SELECT * FROM bbs WHERE userid = :keyid');
            $stmt->bindValue(':keyid', $getid, PDO::PARAM_STR);
            //SQLを実行
            $stmt->execute();


            //取得したデータを１件ずつループしながらクラスに入れていく
            $retList = array();
            while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
                //データを入れるクラスをnew
                $rowData = new UserInfoTblDT();

                //DBから取れた情報をカラム毎に、クラスに入れていく
                $rowData->userid = $row["userid"];
                $rowData->pass = $row["pass"];
                $rowData->username = $row["username"];


                //取得した一件を配列に追加する
                array_push($retList, $rowData);
            }

            $this->dbDisconnect();

            //結果が格納された配列を返す
            return $retList;

        }catch (PDOException $e) {
            print('検索に失敗。'.$e->getMessage());
        }
    }



    //書き込みのメソッド
    public function insertUserInfo($userId, $pass,$username){
        try{
            //DBに接続
            $this->dbConnect();

            $stmt = $this->myPdo -> prepare("INSERT INTO bbs (userid, pass,username) VALUES (:userid, :pass,:username)");
            $stmt->bindValue(':userid', $userId, PDO::PARAM_STR);
            $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);

            //SQL実行
            $stmt->execute();

            //DB切断
            $this->dbDisconnect();

        }catch (PDOException $e) {
            print('書き込み失敗。'.$e->getMessage());
            throw $e;
        }

    }

}
?>
