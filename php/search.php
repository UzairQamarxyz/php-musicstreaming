<?php

include "dbcon.php";

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    echo $search;
    $con = OpenCon();

    if ($stmt = $con->prepare("SELECT tracks.track_id, tracks.track_title, tracks.track_loc, albums.album_name, albums.album_loc, artists.artist_name FROM tracks INNER JOIN albums INNER JOIN albumsxartists INNER JOIN artists ON tracks.album_id = albums.album_id AND albums.album_id = albumsxartists.album_id AND albumsxartists.artist_id = artists.artist_id AND tracks.track_title LIKE '%$search%' OR albums.album_name LIKE '%$search%' OR artists.artist_name LIKE '%$search%' LIMIT 10;"));

    $stmt->execute();
    
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo <<<EOL
                <div class="datacells-tracks">
                <button class="material-icons track-number" onclick="loadTrack('$row[track_loc]', '$row[artist_name]', '$row[track_title]', '$row[album_loc]')">play_circle_filled</button>
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
    }
} else {
    echo <<< EOL
            No Results Found
        EOL;
}
