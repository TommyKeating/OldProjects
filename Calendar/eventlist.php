<?php
            require 'calendar_database.php';
            ini_set("session.cookie_httponly", 1);
            session_start();
            //get user id here
            $user_id = $_SESSION['user_id'];

            $stmt = $mysqli->prepare("SELECT id, event_name, event_date FROM events WHERE (user_id=?) ORDER BY date(event_date) AND time(event_date)");
            $stmt->bind_param('d', $user_id);
            if(!$stmt)
            {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->execute();
            $stmt->bind_result($event_id, $event_name, $event_date);

            $data = Array();
            $event_results = Array();
            $counter = 0;



            while($stmt->fetch())
            {
                $event_results[$counter] = Array();
                $event_results[$counter][0] = htmlentities($event_id);//Per XSS
                $event_results[$counter][1] = htmlentities($event_name);
                $event_results[$counter][2] = htmlentities($event_date);
                $counter++;
            }

            if($counter > 0)
            {
                echo json_encode(array(
                "success" => true,
                "data" => $event_results,
                "runs" => $counter
            ));
            }else
            {
                echo json_encode(array(
                "success" => false,
                "message" => "No Date Found"
                ));
            }

            $stmt->close();
        ?>