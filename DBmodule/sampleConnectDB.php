<?php
// 接続は学内LANからのみ
// データベースに接続するために必要なデータソースを変数に格納
// mysql:host=ホスト名;dbname=データベース名;charset=文字エンコード
   $dsn = 'mysql:host=222.229.69.200;dbname=sampledb;charset=utf8';

// データベースのユーザー名
   $user = 'admin';
// データベースのパスワード
   $password = 'P@ssw0rd';

   try{
  // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);
     
  // sql文を変数に格納
    $sql = "SELECT * FROM USER";
     
  // SQLステートメントを実行し、結果を変数に格納
    $stmt = $dbh->query($sql);

  // foreach文で配列の中身を一行ずつ出力
    foreach ($stmt as $row) {
    // データベースのフィールド名で出力
      echo $row['USER_ID'].':'.$row['USER_NAME'].':'.$row['MAILADDRESS'].':'.$row['PASSWORD'].':'.$row['BIRTHDAY'];
      }
  }catch (PDOException $e) {

    // エラーメッセージを表示させる
      echo 'データベースにアクセスできません！' . $e->getMessage();

    // 強制終了
      exit;
  }
 ?>
