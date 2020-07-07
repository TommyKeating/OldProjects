<?php
require 'calendar_database.php';
ini_set("session.cookie_httponly", 1);
session_start();

header("Content-Type: application/json"); 


$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str, true);


$e_ID = $mysqli->real_escape_string($json_obj['event_identification']);
$event_name = $mysqli->real_escape_string($json_obj['event_name']);
$event_date = $mysqli->real_escape_string($json_obj['event_date']);
$event_tag = $mysqli->real_escape_string($json_obj['event_tag']);
$event_ispublic = $mysqli->real_escape_string($json_obj['event_ispub']);

$stmt = $mysqli->prepare("update events set event_name=?, event_date=?, tag=?, ispublic=? where id=?");


if(!$stmt){
  echo json_encode(array(
		"success" => false,
        "message" => "Incorrect Username or Password"
  ));
	exit;
}

$stmt->bind_param('sssdd', $event_name, $event_date, $event_tag, $event_ispublic, $e_ID);

  if(!$stmt->execute())
  {
    echo $stmt->error;
  }

$stmt->execute();


echo json_encode(array(
    "success" => true,
    "message" => "THIS IS THE PRINT STATEMENT TO RETURN SUCCESS FOR ECHOING IN MOD EVENT".$e_ID
));
$stmt->close();  
  exit;
?>