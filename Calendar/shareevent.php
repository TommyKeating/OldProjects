<?php
require 'calendar_database.php';
ini_set("session.cookie_httponly", 1);
session_start();

header("Content-Type: application/json"); 
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);


$event_id = $mysqli->real_escape_string($json_obj['event_id']);//SQL INJ
$user_id = $mysqli->real_escape_string($json_obj['user_id']);


$stmt = $mysqli->prepare("SELECT event_name, event_date, tag, ispublic FROM events WHERE id = ?");
$stmt->bind_param('d', $event_id);


$stmt->execute();


$stmt->bind_result($event_name, $event_date, $event_tag, $ispublic);

$stmt->fetch();

$stmt->close();

$stmt2 = $mysqli->prepare("insert into events (user_id, event_name, event_date, tag, ispublic) values (?, ?, ?, ?, ?)");
if(!$stmt2){
  echo json_encode(array(
		"success" => false,
    "message" => "Error"
  ));
	exit;
}

  $stmt2->bind_param('dsssd', $user_id, $event_name, $event_date, $event_tag, $ispublic);
  if(!$stmt2->execute())
  {
    echo $stmt2->error;
  }
  $stmt2->close();

  echo json_encode(array(
		"success" => true
	));
	exit;
?>