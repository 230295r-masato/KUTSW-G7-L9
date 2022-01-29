<?php

require("connectDB.php"); //接続用ファイル

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = $array->text1;

try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT DRIVER_ID, GPS_LAT, GPS_LNG FROM DRIVER_INFO
            WHERE DRIVER_ID = :id";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->prepare($sql);
    $params = array(':id'=>$id);
    $stmt->execute($params);

    $OrderedDriverData = array();  //結果格納用配列

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $OrderedDriverData[]=array(
      'DRIVER_ID'=>$row['DRIVER_ID'],
      'GPS_LAT'=>$row['GPS_LAT'],
      'GPS_LNG'=>$row['GPS_LNG']
    );
}

  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($OrderedDriverData);

?>