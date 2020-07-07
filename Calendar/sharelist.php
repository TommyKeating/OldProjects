<?php
        ini_set("session.cookie_httponly", 1);
        session_start();
        $current_uid = $_SESSION["user_id"];
        require 'calendar_database.php';

        $stmt2 = $mysqli->prepare("SELECT id, username FROM users ORDER BY username");

        $stmt2->execute();

        $stmt2->bind_result($user_id, $username);
        $data = Array();
        $event_results = Array();
        $counter = 0;

        while($stmt2->fetch())
            {
                if($current_uid != $user_id)
                {
                    $use_results[$counter] = Array();
                    $use_results[$counter][0] = htmlentities($user_id);//Per XSS
                    $use_results[$counter][1] = htmlentities($username);
                    $counter++;
                }
            }

            if($counter > 0)
            {
                echo json_encode(array(
                "success" => true,
                "data" => $use_results,
                "runs" => $counter
            ));
            }else
            {
                echo json_encode(array(
                "success" => false,
                "message" => "No Date Found"
                ));
            }

            $stmt2->close();
?>
