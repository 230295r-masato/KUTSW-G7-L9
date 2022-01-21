<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = intval($array->text1);
$reserve_time = $array->text2;


try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO test3 * SELECT t.id, t.value FROM test t WHERE t.id = :id";
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