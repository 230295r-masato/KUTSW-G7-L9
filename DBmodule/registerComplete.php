<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
//$id = $array->text1;
$id = '18888888';

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO COMPLETE (COMPLETE.RESERVE_ID, COMPLETE.USER_ID, COMPLETE.DRIVER_ID, COMPLETE.RESERVE_TIME) 
            SELECT O.RESERVE_ID, O.USER_ID, O.DRIVER_ID, O.RESERVE_TIME
            FROM ORDERED O 
            WHERE O.RESERVE_ID = :reserve_id";
    $stmt = $dbh->prepare($sql);

    $params = array(':reserve_id'=>$id);
    $stmt->execute($params);

    $sql = "UPDATE COMPLETE SET USER_NAME = (SELECT USER_NAME FROM USER WHERE USER.USER_ID = COMPLETE.USER_ID) 
            WHERE COMPLETE.RESERVE_ID = :reserve_id";
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id'=>$id);
    $stmt->execute($params);

    $sql = "UPDATE COMPLETE SET DRIVER_NAME = (SELECT DRIVER_NAME FROM DRIVER WHERE DRIVER.DRIVER_ID = COMPLETE.DRIVER_ID) 
            WHERE COMPLETE.RESERVE_ID = :reserve_id";
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id'=>$id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>