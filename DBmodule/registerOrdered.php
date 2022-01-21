<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = intval($array->text1);

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO ORDERED (ORDERED.RESERVE_ID, ORDERED.USER_ID, 
                   ORDERED.RESERVE_TIME, ORDERED.START, ORDERED.GOAL) 
            SELECT N.RESERVE_ID, N.USER_ID, N.RESERVE_TIME, N.START, N.GOAL 
            FROM NRECEIVED N 
            WHERE N.RESERVE_ID = :reserve_id";
    $stmt = $dbh->prepare($sql);
    $params = array(':id'=>$id);
    $stmt->execute($params);

    $sql = "INSERT INTO ORDERED (ORDERED.RESERVE_ID, ORDERED.USER_ID, 
                   ORDERED.RESERVE_TIME, ORDERED.START, ORDERED.GOAL) 
            SELECT I.RESERVE_ID, I.USER_ID, I.RESERVE_TIME, I.START, I.GOAL 
            FROM IMMEDIATRY I 
            WHERE I.RESERVE_ID = :reserve_id";
    $stmt = $dbh->prepare($sql);
    $params = array(':id'=>$id);
    $stmt->execute($params);

    require("selectall.php");
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>