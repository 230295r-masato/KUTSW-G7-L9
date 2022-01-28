<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$name = $array->text1;
$mail = $array->text2;
$pass = $array->text3;
$birthday = $array->text4;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO USER (USER_NAME, MAILADDRESS, PASSWORD, BIRTHDAY) VALUES(:name, :mail, :pass, :birthday)";
    $stmt = $dbh->prepare($sql);
    $params = array(':name'=>$name, ':mail'=>$mail, ':pass'=>$pass, ':birthday'=>$birthday);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>