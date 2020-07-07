<?php
require 'calendar_database.php';
ini_set("session.cookie_httponly", 1);
session_start();

header("Content-Type: application/json"); 
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);

$ename = $mysqli->real_escape_string($json_obj['ename']);
$datime = $mysqli->real_escape_string($json_obj['datime']);
$tag = $mysqli->real_escape_string($json_obj['tag']);
$pub = $mysqli->real_escape_string($json_obj['pub']);
$userID = $_SESSION['user_id'];



$stmt = $mysqli->prepare("insert into events (user_id, event_name, event_date, tag, ispublic) values (?, ?, ?, ?, ?)");
if(!$stmt){
  //printf("Query Prep Failed: %s\n", $mysqli->error);
  echo json_encode(array(
		"success" => false,
    "message" => "Incorrect Username or Password"
  ));
	exit;
}

  $stmt->bind_param('dsssd', $userID, $ename, $datime, $tag, $pub);
 
  $stmt->execute();



  $stmt->close();

  echo json_encode(array(
		"success" => true
	));
	exit;
?>