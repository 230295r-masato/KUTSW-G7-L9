<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = intval($array->text1);
$new_delay = $array->text2;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "UPDATE ORDERD SET DELAY = :new_delay WHERE DRIVER_ID = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':new_delay' => $new_delay, ':id' => $id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'更新できません．');
    echo json_encode($ary);
    exit;
 }

?>