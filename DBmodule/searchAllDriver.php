<?php

require("connectDB.php"); //接続用ファイル

$json = file_get_contents('php://input');
$array = json_decode($json);

try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT * FROM DRIVER";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->query($sql);

    $allDriverData = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $allDriverData[]=array(
    'DRIVER_ID'=>$row['DRIVER_ID'],
    'DRIVER_NAME'=>$row['DRIVER_NAME'],
    'PASSWORD'=>$row['PASSWORD'],
    'LINK'=>$row['LINK']
    );
  }
  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($allDriverData, JSON_UNESCAPED_UNICODE);

?>