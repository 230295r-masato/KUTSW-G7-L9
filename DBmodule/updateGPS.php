<?php

require("connectDB.php");

$json = file_get_contents('php://input');
$array = json_decode($json);
//$id = $array->text1;
//$new_gps_lat = $array->text2;
//$new_gps_lng = $array->text3;
$id = '88888888';
$new_gps_lat = '30.03';
$new_gps_lng = '123.4567';

try{
    $dbh = new PDO($dsn, $user, $password);
    $sql = "UPDATE DRIVER_INFO SET GPS_LAT = :new_gps_lat, GPS_LNG = :new_gps_lng WHERE DRIVER_ID = :id";
    $stmt = $dbh->prepare($sql);
    $params = array(':new_gps_lat' => $new_gps_lat, ':new_gps_lng' => $new_gps_lng, ':id' => $id);
    $stmt->execute($params);
    
 }catch(PDOException $e){
    $ary = array('result'=>'更新できません．');
    exit;
 }

?>