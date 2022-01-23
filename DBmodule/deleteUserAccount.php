<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
$id = $array->text1;

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "DELETE FROM USER WHERE USER_ID = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':id' => $id);
    $stmt->execute($params);

 }catch(PDOException $e){
    $ary = array('result'=>'削除できません．');
    echo json_encode($ary);
    exit;
 }

?>