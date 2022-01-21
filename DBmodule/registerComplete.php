<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = intval($array->text1);

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO COMPLETE (COMPLETE.RESERVE_ID, COMPLETE.USER_ID, 
                   COMPLETE.RESERVE_TIME, COMPLETE.START, COMPLETE.GOAL) 
            SELECT O.RESERVE_ID, O.USER_ID, O.RESERVE_TIME, O.START, O.GOAL 
            FROM ORDERED O 
            WHERE O.RESERVE_ID = :reserve_id";
    $stmt = $dbh->prepare($sql);
    $params = array(':id'=>$id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>