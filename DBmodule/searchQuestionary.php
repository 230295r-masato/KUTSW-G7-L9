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
    $sql = "SELECT * FROM QUESTIONARY WHERE DRiVER_ID = :driver_id";


  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->prepare($sql);
    $params = array(':driver_id' => $driver_id);
    $stmt->execute($params);

    $questionaryData = array();  //結果格納用配列

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $questionaryData[]=array(
      'RESERVE_ID'=>$row['RESERVE_ID'],
      'DRIVER_ID'=>$row['DRIVER_ID'],
      'SCORE'=>$row['SCORE'],
      'COMMENT'=>$row['COMMENT']
    );
}

  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($questionaryData, JSON_UNESCAPED_UNICODE);

?>