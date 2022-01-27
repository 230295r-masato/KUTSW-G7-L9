<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = $array->text1;
$new_address = $array->text2;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "UPDATE USER SET MAILADDRESS = :new_address WHERE USER_ID = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':new_address' => $new_address, ':id' => $id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'更新できません．');
    exit;
 }

?>