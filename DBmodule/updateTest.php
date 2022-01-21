<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = intval($array->text1);
$new_value = $array->text2;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "UPDATE test SET value = :new_value WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':new_value' => $new_value, ':id' => $id);
    $stmt->execute($params);

    require("selectall.php");
    
 }catch(PDOException $e){
    $ary = array('result'=>'更新できません．');
    echo json_encode($ary);
    exit;
 }

?>