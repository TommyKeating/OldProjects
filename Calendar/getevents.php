<?php
require 'calendar_database.php';
ini_set("session.cookie_httponly", 1);
session_start();

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];


header("Content-Type: application/json"); 


$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str, true);


$month = $mysqli->real_escape_string($json_obj['month']);
$day = $mysqli->real_escape_string($json_obj['day']);
$year = $mysqli->real_escape_string($json_obj['year']);
$date_str = $year.'-'.$month.'-'.$day;
$datetime = new DateTime($date_str);
$datetime = $datetime->format('Y-m-d');

//get public events as well
$value = 1;


$stmt = $mysqli->prepare("SELECT id, event_name, event_date, tag, ispublic FROM events WHERE (user_id=? OR ispublic=?) AND date(event_date)=? ORDER BY time(event_date)");
$stmt->bind_param('dds', $user_id, $value, $datetime);


$stmt->execute();


$stmt->bind_result($event_id, $event_name, $event_date, $event_tag, $ispublic);


$data = Array();
$event_results = Array();
$counter = 0;



while($stmt->fetch()){
    $event_results[$counter] = Array();
    $event_results[$counter][0] = htmlentities($event_id);//Per XSS
    $event_results[$counter][1] = htmlentities($event_name);
    $event_results[$counter][2] = htmlentities($event_date);
    $event_results[$counter][3] = htmlentities($event_tag);
    $event_results[$counter][4] = htmlentities($ispublic);
    $counter++;
}




if($counter > 0){
    echo json_encode(array(
        "success" => true,
        "data" => $event_results,
        "runs" => $counter
    ));
}else{
    echo json_encode(array(
        "success" => false,
        "message" => "No Date Found"
    ));
}

$stmt->close();
?>