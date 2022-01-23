<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$reserve_id = $array->text1;
$user_id = $array->text2;
$reserve_time = $array->text3;
$start = $array->text4;
$goal = $array->text5;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO IMMEDIATRY VALUES(:reserve_id, :user_id, :reserve_time, :start, :goal)";
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id'=>$reserve_id, ':user_id'=>$user_id, ':reserve_time'=>$reserve_time, ':start'=>$start, ':goal'=>$goal);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>