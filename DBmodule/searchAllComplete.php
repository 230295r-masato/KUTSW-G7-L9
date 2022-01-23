<?php

require("connectDB.php"); //接続用ファイル

$json = file_get_contents('php://input');
//$array = json_decode($json);

try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT * FROM COMPLETE";

  // SQLステートメントを実行し、結果を変数に格納

    $stmt = $dbh->query($sql);

    $allCompleteData = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $allCompleteData[]=array(
    'RESERVE_ID'=>$row['RESERVE_ID'],
    'USER_ID'=>$row['USER_ID'],
    'USER_NAME'=>$row['USER_NAME'],
    'DRIVER_ID'=>$row['DRIVER_ID'],
    'DRIVER_NAME'=>$row['DRIVER_NAME'],
    'RESERVE_TIME'=>$row['RESERVE_TIME']
    );
  }

  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($allCompleteData, JSON_UNESCAPED_UNICODE);

?>