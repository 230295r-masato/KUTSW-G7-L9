<?php

require("connectDB.php"); //接続用ファイル

$json = file_get_contents('php://input');
$array = json_decode($json);
//$driver_id = $array->text1;
$driver_id = '88888888';
try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT * FROM DRIVER_INFO WHERE DRIVER_ID = :driver_id";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->prepare($sql);
    $params = array(':driver_id' => $driver_id);
    $stmt->execute($params);

    $freeDriverData = array();  //結果格納用配列

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $freeDriverData[]=array(
      'DRIVER_ID'=>$row['DRIVER_ID'],
      'GPS_LAT'=>$row['GPS_LAT'],
      'GPS_LNG'=>$row['GPS_LNG'],
      'TAXI_STATUS'=>$row['TAXI_STATUS']
    );
}

  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($freeDriverData);

?>