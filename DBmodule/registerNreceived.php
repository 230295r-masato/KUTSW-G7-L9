<?php

require("connectDB.php");

//$json = file_get_contents('php://input');
//$array = json_decode($json);
//$reserve_id = intval($array->text1);
//$user_id = intval($array->text2);
//$reserve_time = $array->text3;
//$start_lat = $array->text4;
//$start_lng = $array->text5;
//$goal_lat = $array->text6;
//$goal_lng = $array->text7;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO NRECEIVED VALUES(:reserve_id, :user_id, :reserve_time, :start_lat, :start_lng, :goal_lat, :goal_lng)";
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id'=>$reserve_id, ':user_id'=>$user_id, ':reserve_time'=>$reserve_time, ':start_lat'=>$start_lat, ':start_lng'=>$start_lng, ':goal_lat'=>$goal_lat, ':goal_lng'=>$goal_lng);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>