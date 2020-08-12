<?php
    session_start();
    include "dbcon.php";

    
    $con = OpenCon();

    if ($stmt0 = $con->prepare("SELECT COUNT(*) FROM playlists_contents WHERE playlists_contents.user_id = ? and playlists_contents.playlist_id = ? and playlists_contents.track_id = ?")) {
        $stmt0->bind_param("iii", $_SESSION["id"], $_POST["playlist_id"], $_POST["track_id"]);
        $stmt0->execute();
        $stmt0->bind_result($found);

        $stmt0->fetch();

        if ($found == 0) {
            $con =  OpenCon();

            echo $found;
            if ($stmt = $con->prepare("INSERT INTO `playlists_contents` (`user_id`, `playlist_id`, `track_id`) VALUES (?, ?, ?);")) {
                $stmt->bind_param("iii", $_SESSION["id"], $_POST["playlist_id"], $_POST["track_id"]);
                $stmt->execute();
                echo "added";
            }
        } elseif ($found == 1) {
            $con =  OpenCon();

            echo $found;
            if ($stmt = $con->prepare("DELETE FROM `playlists_contents` WHERE `user_id` = ? AND `playlist_id` = ? AND `track_id` =?;")) {
                $stmt->bind_param("iii", $_SESSION["id"], $_POST["playlist_id"], $_POST["track_id"]);
                $stmt->execute();
                echo "removed";
            }
        }
    }
    CloseCon($con);
