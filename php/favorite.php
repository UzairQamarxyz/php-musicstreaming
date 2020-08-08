<?php
    session_start();
    include "dbcon.php";
    
    $con = OpenCon();

    if ($stmt = $con->prepare("INSERT INTO userxlikes (user_id, track_id) VALUES (?, ?);")) {
        echo "I AM SESSION".$_SESSION["id"];
        echo "I AM POST".$_POST["id"];
        $stmt->bind_param("ii", $_SESSION["id"], $_POST["id"]);
        $stmt->execute();
        echo "LIKED";
    } else {
        echo "An Error Occured While Inserting Data!";
    }
?>
