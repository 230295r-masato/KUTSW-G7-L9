<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = intval($array->text1);
$name = $array->text2;
$mail = $array->text3;
$pass = $array->text4;
$birthday = $array->text5;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO USER VALUES(:id, :name, :mail, :pass, :birthday)";
    $stmt = $dbh->prepare($sql);
    $params = array(':id'=>$id, ':name'=>$name, ':mail'=>$mail, ':pass'=>$pass, ':birthday'=>$birthday);
    $stmt->execute($params);

    require("selectall.php");
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>