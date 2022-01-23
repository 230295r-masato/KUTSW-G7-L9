<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
//$id = $array->text1;
$id = '19999999';

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO COMPLETE (COMPLETE.RESERVE_ID, COMPLETE.RESERVE_TIME, COMPLETE.DRIVER_ID) 
            SELECT O.RESERVE_ID, O.RESERVE_TIME, O.DRIVER_ID 
            FROM ORDERED O 
            WHERE O.RESERVE_ID = :reserve_id";
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id'=>$id);
    $stmt->execute($params);

//    $sql = "INSERT INTO COMPLETE (COMPLETE.USER_NAME) 
//            SELECT U.USER_NAME
//            FROM USER U 
//            WHERE U.USER_ID = ORDERED.USER_ID";
//    $stmt = $dbh->query($sql);
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>