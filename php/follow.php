<?php
    session_start();
    include "dbcon.php";
    
    $con = OpenCon();

    if ($stmt0 = $con->prepare("SELECT COUNT(*) FROM userxartists where user_id = ? and artist_id = ?")) {
        $stmt0->bind_param("ii", $_SESSION["id"], $_POST["id"]);
        $stmt0->execute();
        $stmt0->bind_result($found);

        $stmt0->fetch();

        if ($found == 0) {
            $con =  OpenCon();

            if ($stmt = $con->prepare("INSERT INTO userxartists (user_id, artist_id) VALUES (?, ?);")) {
                $stmt->bind_param("ii", $_SESSION["id"], $_POST["id"]);
                $stmt->execute();
                echo "following";
            }
        } elseif ($found == 1) {
            $con =  OpenCon();

            if ($stmt = $con->prepare("DELETE FROM userxartists WHERE user_id = ? AND artist_id = ?;")) {
                $stmt->bind_param("ii", $_SESSION["id"], $_POST["id"]);
                $stmt->execute();
                echo "unfollowing";
            }
        }
    }
    CloseCon($con);
?>
