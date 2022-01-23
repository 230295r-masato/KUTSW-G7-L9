<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$reserve_id = $array->text1;
$user_id = $array->text2;
$score = intval($array->text3);
$comment = $array->text4;
$reserve_time = $array->text5;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO QUESTIONARY VALUES(:reserve_id, :user_id, :score, :comment, :reserve_time)";
    $stmt = $dbh->prepare($sql);
    $params = array(':reserve_id'=>$reserve_id, ':user_id'=>$user_id, ':score'=>$score, ':comment'=>$comment, ':reserve_time'=>$reserve_time);
    $stmt->execute($params);

    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>