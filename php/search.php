<?php

include "dbcon.php";

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $con = OpenCon();

    if ($stmt = $con->prepare("SELECT * FROM searchinfo WHERE track_title LIKE '%$search%' OR album_name LIKE '%$search%' OR artist_name LIKE '%$search%'")) {
        $stmt->execute();
    
        $result = $stmt->get_result();
        echo <<< EOL
        <p id="datagrid-heading">Search Results for "$search"</p>
        <div id="datacells">
            <div id="datacells-heading">
                <span class="track-number track-no">#</span>
                <span class="track-number track-fav"></span>
                <span class="track-title">TITLE</span>
                <span class="track-artist">ARTIST</span>
                <span class="track-album">ALBUM</span>
            </div>
        EOL;
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            echo <<<EOL
                <div class="datacells-tracks">
                <button class="material-icons track-number" data-count=$count onclick="loadTrack('$row[track_loc]', '$row[artist_name]', '$row[track_title]', '$row[album_loc]', $count)">play_circle_filled</button>
                EOL;

            $con =  OpenCon();
            if ($stmt1 = $con->prepare("SELECT COUNT(*) FROM userxlikes where user_id = ? and track_id = ?")) {
                $stmt1->bind_param("ii", $_SESSION["id"], $row[track_id]);
                $stmt1->execute();
                $stmt1->bind_result($found);

                $stmt1->fetch();
                
                if ($found == 0) {
                    echo <<<EOL
                        <button class="material-icons favorite" data-id='$row[track_id]' onclick="favorite('$row[track_id]')")">favorite_border</button>
                    EOL;
                } else {
                    echo <<<EOL
                        <button class="material-icons favorite" data-id='$row[track_id]' onclick="favorite('$row[track_id]')")">favorite</button>
                    EOL;
                }
            }

            echo <<<EOL
                <span class="track-title">$row[track_title]</span>
                <span class="track-artist">$row[artist_name]</span>
                <span class="track-album">$row[album_name]</span>
            </div>
            EOL;
            $count++;
        }
    } else {
        echo <<< EOL
            No Results Found
        EOL;
    }
}
