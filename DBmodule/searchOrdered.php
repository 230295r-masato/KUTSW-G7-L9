<?php

require("connectDB.php"); //接続用ファイル

$json = file_get_contents('php://input');
$array = json_decode($json);
$reserve_id = $array->text1;

try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT * FROM ORDERED WHERE RESERVE_ID = :reserve_id";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id' => $reserve_id);
    $stmt->execute($params);

    $orderedData = array();  //結果格納用配列

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $orderedData[]=array(
      'RESERVE_ID'=>$row['RESERVE_ID'],
      'USER_ID'=>$row['USER_ID'],
      'DRIVER_ID'=>$row['DRIVER_ID'],
      'START_LAT'=>$row['START_LAT'],
      'START_LNG'=>$row['START_LNG'],
      'GOAL_LAT'=>$row['GOAL_LAT'],
      'GOAL_LNG'=>$row['GOAL_LNG'],
      'DELAY'=>$row['DELAY']
    );
}

  }catch (PDOException $e) {

    // 強制終了
      exit;
  }

echo json_encode($orderedData);

?>