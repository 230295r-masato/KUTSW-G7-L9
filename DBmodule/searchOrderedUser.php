<?php

require("connectDB.php"); //接続用ファイル

$json = file_get_contents('php://input');
$array = json_decode($json);
$user_id = $array->text1;

try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);

  // SELECT文を変数に格納
    $sql = "SELECT * FROM ORDERED WHERE USER_ID = :user_id";

  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->query($sql);

    $list = [];  //結果格納用配列
  // foreach文で配列の中身を一行ずつ出力
    foreach ($stmt as $row) {
    // データベースのフィールド名で出力
   array_push($list, $row['RESERVE_ID'].':'.$row['DRIVER_ID'].':'.$row['USER_ID'].':'.$row['RESERVE_TIME'].':'.$row['START'].':'.$row['GOAL'].':'.$row[DELAY]);
      }

  $str = implode("\n", $list);
  $ary = array('result'=>$str);

  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      //echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }

echo json_encode($ary);

?>