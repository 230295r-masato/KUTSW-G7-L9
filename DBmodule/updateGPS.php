<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = intval($array->text1);
$new_gps = $array->text2;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "UPDATE DRIVER_INFO SET DRIVER_GPS = :new_gps WHERE DRIVER_ID = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':new_gps' => $new_gps, ':id' => $id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'更新できません．');
    echo json_encode($ary);
    exit;
 }

?>