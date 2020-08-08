<?php

include "dbcon.php";

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $con = OpenCon();
    if ($stmt = $con->prepare("SELECT tracks.track_id,tracks.track_title, albums.album_name, albums.album_loc, artists.artist_name, tracks.track_loc from tracks INNER JOIN albums INNER JOIN artists WHERE tracks.album_id = albums.album_id and tracks.artist_id = artists.artist_id;")) {
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo <<<EOL
                <button class="material-icons track-number" onclick="loadTrack('$location','$artist','$title')">play_circle_filled</button>
                <span class="track-title">$row[track_title]</span>
                <span class="track-artist">$row[track_artist]</span>
                <span class="track-album">$row[track_album]</span>
                </div>;
            EOL;
        }
    }
} else {
    echo <<< EOL
            No Results Found
        EOL;
}
