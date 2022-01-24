<?php

require("connectDB.php"); //接続用ファイル

//$json = file_get_contents('php://input');
//$array = json_decode($json);

try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT * FROM USER";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->query($sql);

    $userData = array();  //結果格納用配列

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $userData[]=array(
      'USER_ID'=>$row['USER_ID'],
      'USER_NAME'=>$row['USER_NAME'],
      'MAILADDRESS'=>$row['MAILADDRESS'],
      'PASSWORD'=>$row['PASSWORD'],
      'BIRTHDAY'=>$row['BIRTHDAY']
    );
}

  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($userData, JSON_UNESCAPED_UNICODE);

?>
