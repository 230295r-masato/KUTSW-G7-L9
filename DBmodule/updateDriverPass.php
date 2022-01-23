<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = $array->text1;
$new_pass = $array->text2;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "UPDATE driver SET password = :new_pass WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':new_pass' => $new_pass, ':id' => $id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'更新できません．');
    exit;
 }

?>