<?php
        require 'calendar_database.php';
        ini_set("session.cookie_httponly", 1);
        session_start();
        //get user id here
        $user_id = $_SESSION['user_id'];

        $stmt = $mysqli->prepare("SELECT id, event_name FROM events WHERE (user_id=?) ORDER BY date(event_date) AND time(event_date)");
        $stmt->bind_param('d', $user_id);
        if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
        }
        $stmt->execute();
        $stmt->bind_result($event_id, $event_name);

        while($stmt->fetch())
            {
            printf("<h1>%s</h1>", htmlspecialchars($event_name));
            printf("<button type='button' class='btn' onclick='eChange($event_id)'>Edit Event</button>");
            printf("<button type='button' class='btn' id='delete_btn' onclick='eDelete($event_id)'>Delete Event</button>\n");
            }
        ?>