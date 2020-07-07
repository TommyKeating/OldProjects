<?php
require 'calendar_database.php';
ini_set("session.cookie_httponly", 1);
session_start();


$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];


header("Content-Type: application/json"); 


$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str, true);

$event_id = $mysqli->real_escape_string($json_obj['event_id']); //SQL INJ

$stmt = $mysqli->prepare("SELECT event_name, event_date, tag, ispublic FROM events WHERE id = ?");
$stmt->bind_param('d', $event_id);


$stmt->execute();


$stmt->bind_result($event_name, $event_date, $event_tag, $ispublic);

$event_results = Array();

$stmt->fetch();

    $event_results[0] = htmlentities($event_id); ///Per XSS
    $event_results[1] = htmlentities($event_name);
    $event_results[2] = htmlentities($event_date);
    $event_results[3] = htmlentities($event_tag);
    $event_results[4] = htmlentities($ispublic);

    echo json_encode(array(
        "success" => true,
        "message" => $event_results,
    ));

$stmt->close();
?>