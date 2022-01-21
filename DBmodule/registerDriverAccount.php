<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = intval($array->text1);
$name = $array->text2;
$pass = $array->text3;


try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "INSERT INTO DRIVER VALUES(:id, :name, :pass)";
    $stmt = $dbh->prepare($sql);
    $params = array(':id'=>$id, ':name'=>$name, ':pass'=>$pass);
    $stmt->execute($params);

    require("selectall.php");
    
 }catch(PDOException $e){
    $ary = array('result'=>'挿入できません．');
    echo json_encode($ary);
    exit;
 }

?>