<?php
    require 'calendar_database.php';
    header("Content-Type: application/json"); 
    ini_set("session.cookie_httponly", 1);
    session_start();
    session_destroy();
    header("Location: calendarone.php");
    echo "<script>document.getElementById('calendar_page').style.display = 'none';</script>";
    echo "<script>document.getElementById('login_page').style.display = 'block';</script>";
?>