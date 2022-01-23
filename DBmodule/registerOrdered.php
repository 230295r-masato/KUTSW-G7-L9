<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
//$reserve_id = $array->text1;
$reserve_id = '18888888';
try{
    $dbh = new PDO($dsn, $user, $password);

    $sql = "INSERT INTO ORDERED (ORDERED.RESERVE_ID, ORDERED.USER_ID, ORDERED.RESERVE_TIME, ORDERED.START_LAT, ORDERED.START_LNG, ORDERED.GOAL_LAT, ORDERED.GOAL_LNG)
            SELECT I.RESERVE_ID, I.USER_ID, I.RESERVE_TIME, I.START_LAT, I.START_LNG, I.GOAL_LAT, I.GOAL_LNG
            FROM IMMEDIATRY I
            WHERE I.RESERVE_ID = :reserve_id";
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id'=>$reserve_id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>