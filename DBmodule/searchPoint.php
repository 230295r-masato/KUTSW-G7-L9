<?php

require("connectDB.php"); //接続用ファイル

$json = file_get_contents('php://input');
$array = json_decode($json);
//$reserve_id = $array->text1;
$reserve_id = '09999999';
try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT START_LAT, START_LNG, GOAL_LAT, GOAL_LNG FROM ORDERED WHERE RESERVE_ID = :reserve_id";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id' => $reserve_id);
    $stmt->execute($params);

    $pointData = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $pointData[]=array(
    'START_LAT'=>$row['START_LAT'],
    'START_LNG'=>$row['START_LNG'],
    'GOAL_LAT'=>$row['GOAL_LAT'],
    'GOAT_LNG'=>$row['GOAL_LNG']
    );
}

  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($pointData);

?>