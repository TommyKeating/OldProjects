<?php
require 'calendar_database.php';
ini_set("session.cookie_httponly", 1);
session_start();

header("Content-Type: application/json");

$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);

$event_id = $mysqli->real_escape_string($json_obj['event_id']); //SQL INJ

$stmt = $mysqli->prepare("DELETE FROM events WHERE id = ?");

if(!$stmt){
  echo json_encode(array(
		"success" => false,
    "message" => "UNABLE TO DELETE"
  ));
	exit;
}
  $stmt->bind_param('d', $event_id);
  if(!$stmt->execute())
  {
    echo $stmt->error;
  }

  $stmt->close();

  echo json_encode(array(
    "success" => true,
    "message" => "SUCCESS!"
	));
	exit;
?>