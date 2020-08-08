<?php
    session_start();
    include "dbcon.php";

    
    $con = OpenCon();

    if ($stmt0 = $con->prepare("SELECT COUNT(*) FROM userxlikes where user_id = ? and track_id = ?")) {
        $stmt0->bind_param("ii", $_SESSION["id"], $_POST["id"]);
        $stmt0->execute();
        $stmt0->bind_result($found);

        $stmt0->fetch();

        if ($found == 0) {
            $con =  OpenCon();

            if ($stmt = $con->prepare("INSERT INTO userxlikes (user_id, track_id) VALUES (?, ?);")) {
                $stmt->bind_param("ii", $_SESSION["id"], $_POST["id"]);
                $stmt->execute();
                echo "LIKED";
            }
        } elseif ($found == 1) {
            $con =  OpenCon();

            if ($stmt = $con->prepare("DELETE FROM userxlikes WHERE user_id = ? AND track_id = ?;")) {
                $stmt->bind_param("ii", $_SESSION["id"], $_POST["id"]);
                $stmt->execute();
                echo "DISLIKED";
            }
        }
    }
