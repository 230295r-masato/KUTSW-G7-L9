<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = $array->text1;
$new_status = $array->text2;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "UPDATE DRIVER_INFO SET TAXI_STATUS = :new_status WHERE DRIVER_ID = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':new_status' => $new_status, ':id' => $id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'更新できません．');
    exit;
 }

?>