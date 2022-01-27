<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$user_id = $array->text1);
$reserve_time = $array->text2;
$start_lat = $array->text3;
$start_lng = $array->text4;
$goal_lat = $array->text5;
$goal_lng = $array->text6;


try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO NRECEIVED (USER_ID, RESERVE_TIME, START_LAT, START_LNG, GOAL_LAT, GOAL_LNG) VALUES(:user_id, :reserve_time, :start_lat, :start_lng, :goal_lat, :goal_lng)";
    $stmt = $dbh->prepare($sql);
    $params = array(':user_id'=>$user_id, ':reserve_time'=>$reserve_time, ':start_lat'=>$start_lat, ':start_lng'=>$start_lng, ':goal_lat'=>$goal_lat, ':goal_lng'=>$goal_lng);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>