<?php

include "dbcon.php";

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $con = OpenCon();

    echo <<< EOL
        <p id="datagrid-heading">Search Results for "$search"</p>
        <div id="datacells-browse">
        EOL;

    // ARTISTS
    if ($stmt = $con->prepare("SELECT * FROM searchinfo WHERE track_title LIKE '%$search%' OR album_name LIKE '%$search%' OR artist_name LIKE '%$search%'")) {
        $stmt->execute();
        $result = $stmt->get_result();

        echo <<< EOL
            <div class="gallery-outerdiv">
                <h2 class="gallery-heading">Artists</h2>
                    <div class="gallery-innerdiv">
        EOL;

        while ($row = $result->fetch_assoc()) {
            echo <<< EOL
                        <div class="album-gallery">
                            <a class="browse-artist" href="#">
                                <img src='{$row["artist_loc"]}' alt="arist" width="200" height="200" onclick="artistNav('{$row["artist_id"]}', '{$row["artist_name"]}', '{$row["artist_loc"]}')" style="border-radius: 50%;">
                            </a>
                            <div class="desc">{$row["artist_name"]}</div>
                        </div>
            EOL;
        }
        echo <<< EOL
                    </div>
                </div>
        EOL;

           
        // ALBUMS
        if ($stmt = $con->prepare("SELECT * FROM searchinfo WHERE track_title LIKE '%$search%' OR album_name LIKE '%$search%' OR artist_name LIKE '%$search%'")) {
            $stmt->execute();
            $result = $stmt->get_result();

            echo <<< EOL
                <div class="gallery-outerdiv">
                    <h2 class="gallery-heading">Albums</h2>
                        <div class="gallery-innerdiv">
            EOL;

            while ($row = $result->fetch_assoc()) {
                echo <<< EOL
                    <div class="album-gallery">
                        <a class="browse-album" href="#">
                            <img class="browse-album-select" src="{$row["album_loc"]}" alt="album art" onclick="albumNav('{$row["album_name"]}','{$row["artist_name"]}','{$row["album_loc"]}')" width="200" height="200">
                        </a>
                    <div class="desc">{$row["album_name"]}</div>
                </div>
                EOL;
            }
        }
        echo <<< EOL
                </div>
            </div>
        EOL;
    }
    if ($stmt = $con->prepare("SELECT * FROM searchinfo WHERE track_title LIKE '%$search%' OR album_name LIKE '%$search%' OR artist_name LIKE '%$search%'")) {
        $stmt->execute();
    
        $result = $stmt->get_result();
        echo <<< EOL
                <div class="gallery-outerdiv">
        <h2 class="gallery-heading">Tracks</h2>
        <div id="datacells">
            <div id="datacells-heading">
                <span class="track-number track-no">#</span>
                <span class="track-number track-fav"></span>
                <span class="track-title">TITLE</span>
                <span class="track-artist">ARTIST</span>
                <span class="track-album">ALBUM</span>
                <span class="track-addtoplaylist"></span>
            </div>
        EOL;

        $count = 0;

        while ($row = $result->fetch_assoc()) {
            echo <<<EOL
                <div class="datacells-tracks">
                <button class="material-icons track-number track-number-a" data-count={$count} onclick="loadTrack('{$row["track_loc"]}', '{$row["artist_name"]}', '{$row["track_title"]}', '{$row["album_loc"]}', {$count})">play_circle_filled</button>
                EOL;
            $count++;

            $con = OpenCon();
            if ($stmt1 = $con->prepare("SELECT COUNT(*) FROM userxlikes where user_id = ? and track_id = ?")) {
                $stmt1->bind_param("ii", $_SESSION["id"], $row["track_id"]);
                $stmt1->execute();
                $stmt1->bind_result($found);

                $stmt1->fetch();
                
                if ($found == 0) {
                    echo <<<EOL
                        <button class="material-icons favorite favorite-a" data-id='{$row["track_id"]}' onclick="favorite('{$row["track_id"]}')")">favorite_border</button>
                    EOL;
                } else {
                    echo <<<EOL
                        <button class="material-icons favorite favorite-a" data-id='{$row["track_id"]}' onclick="favorite('{$row["track_id"]}')")">favorite</button>
                    EOL;
                }
            }

            echo <<<EOL
                <span class="track-title track-title-a">{$row["track_title"]}</span>
                <span class="track-artist track-artist-a" onclick="artistNav('{$row["artist_id"]}', '{$row["artist_name"]}', '{$row["artist_loc"]}', 1)">{$row["artist_name"]}</span>
                <span class="track-album track-album-a" onclick="albumNav('{$row["album_name"]}', '{$row["album_loc"]}', '{$row["artist_name"]}', 1)">{$row["album_name"]}</span>
            </div>
            EOL;
        }
        echo <<< EOL
        </div>
        EOL;
    } else {
        echo <<< EOL
            No Results Found
        EOL;
    }
    CloseCon($con);
}
