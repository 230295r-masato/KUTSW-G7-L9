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

    $driverData = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $completeData[]=array(
    'reserve_id'=>$row['RESERVE_ID'],
    'user_name'=>$row['USER_NAME'],
    'driver_id'=>$row['DRIVER_ID'],
    'reserve_time'=>$row['RESERVE_TIME']
    );
  }
  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

//echo json_encode($ary);

?>
