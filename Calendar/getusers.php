<?php
require 'calendar_database.php';
ini_set("session.cookie_httponly", 1);
session_start();

header("Content-Type: application/json"); 


$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str, true);



$stmt = $mysqli->prepare("SELECT id, username FROM users ORDER BY username");


$stmt->execute();


$stmt->bind_result($user_id, $username);


$data = Array();
$user_results = Array();
$counter = 0;



while($stmt->fetch()){
    $user_results[$counter] = Array();
    $user_results[$counter][0] = htmlentities($user_id);//Per XSS
    $user_results[$counter][1] = htmlentities($username);
    $counter++;
}




if($counter > 0){
    echo json_encode(array(
        "success" => true,
        "data" => $user_results
    ));
}else{
    echo json_encode(array(
        "success" => false,
        "message" => "No Date Found"
    ));
}

$stmt->close();
?>