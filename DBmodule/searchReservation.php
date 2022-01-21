<?php

require("connectDB.php"); //接続用ファイル

$json = file_get_contents('php://input');
$array = json_decode($json);
$user_id = $array->text1;
//$user_id = "99999999";

try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT * FROM NRECEIVED WHERE USER_ID = :user_id";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->prepare($sql);
    $params = array(':user_id' => $user_id);
    $stmt->execute($params);

    $nreceivedData = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $nreceivedData[]=array(
    'reserve_id'=>$row['RESERVE_ID'],
    'user_id'=>$row['USER_ID'],
    'reserve_time'=>$row['RESERVE_TIME'],
    'start'=>$row['START'],
    'goal'=>$row['GOAL']
    );
}

//ORDERD用

      // SELECT文を変数に格納
    $sql = "SELECT * FROM ORDERED WHERE USER_ID = :user_id";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->prepare($sql);
    $params = array(':user_id' => $user_id);
    $stmt->execute($params);

    $orderedData = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $orderedData[]=array(
    'reserve_id'=>$row['RESERVE_ID'],
    'user_id'=>$row['USER_ID'],
    'reserve_time'=>$row['RESERVE_TIME'],
    'start'=>$row['START'],
    'goal'=>$row['GOAL'],
    'delay' =>$row['DELAY']
    );
}


  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($nreceivedData);
echo json_encode($orderedData);

?>