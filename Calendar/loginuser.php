<?php
require 'calendar_database.php';

header("Content-Type: application/json"); 
$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str, true);

$password = $json_obj['password'];

$stmt = $mysqli->prepare("SELECT COUNT(*), id, password FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $user); 
$user = $mysqli->real_escape_string($json_obj['username']);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

// Compare the submitted password to the actual password hash
if($cnt == 1 && password_verify($password, $pwd_hash)){
	ini_set("session.cookie_httponly", 1);
	session_start();
	
	$_SESSION['username'] = $username;
	$_SESSION['user_id'] = $user_id;
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));

	echo json_encode(array(
		"success" => true,
		"message" => "!".$password."!"
	));

	exit;
}else{
	echo json_encode(array(
		"success" => false,
		"message" => "!".$password."!"
	));
	exit;
}
$stmt->close();

?>
