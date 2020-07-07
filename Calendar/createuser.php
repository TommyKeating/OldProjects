<?php
require 'calendar_database.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

//Because you are posting the data via fetch(), php has to retrieve it elsewhere.
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

//Variables can be accessed as such:
$username = $mysqli->real_escape_string($json_obj['username']);
//$password = password_hash($json_obj['password'], PASSWORD_BCRYPT);
//$password = $json_obj['password'];
$password = $mysqli->real_escape_string($json_obj['password']);//added SQL inject protect
$password = password_hash($password, PASSWORD_BCRYPT);
$match = '/^[\w_\-]+$/'; //test to see if you can add a space

// Get the username and make sure it is valid
if(!preg_match($match, $username))
{
  echo json_encode(array(
    "success" => false,
    "message" => "Please remove special characters from username"
  ));
  exit;
}

$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
}

$select_statement = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE username=?");

// Bind the parameter
$select_statement->bind_param('s', $username);
$select_statement->execute();

$select_statement->bind_result($cnt);
$select_statement->fetch();
$select_statement->close();


if($cnt) {
  echo json_encode(array(
    "success" => false,
    "message" => "Username already taken. Try another."
  ));
  exit;
} else {
  $stmt->bind_param('ss', $username, $password);
  $stmt->execute();
  $stmt->close();

  echo json_encode(array(
    "success" => true
  ));
  exit;

}
?>
