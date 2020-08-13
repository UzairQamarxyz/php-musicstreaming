<?php
    session_start();
    include "dbcon.php";
    
    $con = OpenCon();
        echo "AAAAAAAAAAAAAAAA";

    if (isset($_POST["name"])) {
        if ($stmt0 = $con->prepare("SELECT MAX(playlist_id) as total_playlists FROM users_playlists WHERE user_id = ?")) {
            $stmt0->bind_param("i", $_SESSION["id"]);
            $stmt0->execute();
            $stmt0->bind_result($max);

            $stmt0->fetch();

            $playlist_id=$max+1;

            $con = OpenCon();
            if ($stmt = $con->prepare("INSERT INTO users_playlists (user_id, playlist_id, playlist_name) VALUES (?, ?, ?)")) {
                $stmt->bind_param("iis", $_SESSION["id"], $playlist_id, $_POST["name"]);
                $stmt->execute();
                echo "added";
            }
        } else {
            echo "error";
        }
    }
    CloseCon($con);
