<?php
  ini_set("session.cookie_httponly", 1);
    session_start();
    $user_id = $_SESSION['user_id'];
    echo json_encode(array(
		"UID" => $user_id
	));
	exit;
?>