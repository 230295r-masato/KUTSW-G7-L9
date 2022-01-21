<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$a = intval($array->text1);
$b = $array->text2;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO test VALUES(:id, :value)";
    $stmt = $dbh->prepare($sql);
    $params = array(':id'=>$a, ':value'=>$b);
    $stmt->execute($params);

    require("selectall.php");
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>