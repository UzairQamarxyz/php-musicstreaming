<?php
session_start();
$_SESSION['current'] = 'artist.php';

include "dbcon.php";
?>

<button class="material-icons back" onclick="$('#browse-page').click()">arrow_back_ios</button>

<div id="album-area">
<img id="album-picture" style="border-radius:50%;" src='<?=$_COOKIE["artist_loc"] ?>'>
    <div id="artist-profile">
        <p id="artist-artist-name"><?=$_COOKIE["artist_name"] ?></p>
<?php
$con = OpenCon();
if ($stmt = $con->prepare("SELECT artist_desc FROM artists WHERE artist_name = '$_COOKIE[artist_name]'")) {
    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
}
echo <<< EOL
        <p id="artist-artist-desc">${row["artist_desc"]}</p>
    EOL;
    CloseCon($con);

$con =  OpenCon();
if ($stmt1 = $con->prepare("SELECT COUNT(*) FROM userxartists WHERE userxartists.user_id = ? and userxartists.artist_id = ?")) {
    $stmt1->bind_param("ii", $_SESSION["id"], $_COOKIE["artist_id"]);
    $stmt1->execute();
    $stmt1->bind_result($found);

    $stmt1->fetch();

    if ($found == 0) {
        echo <<<EOL
        <button class="follow" onclick="follow('{$_COOKIE["artist_id"]}')">Follow</button>
        EOL;
    } else {
        echo <<<EOL
        <button class="unfollow" onclick="follow('{$_COOKIE["artist_id"]}')">Following</button>
        EOL;
    }
}
?>
    </div>
</div>

<!-- DATA CELLS -->
<div id="datacells-artist">
    <p id="datagrid-heading">Albums By <?=$_COOKIE["artist_name"]?></p>
<?php
    $con = OpenCon();

    if ($stmt = $con->prepare('SELECT albums.album_name,albums.album_loc FROM albums JOIN albumsxartists JOIN artists ON albums.album_id = albumsxartists.album_id AND albumsxartists.artist_id = artists.artist_id AND artists.artist_name = ?')) {
        $stmt->bind_param('s', $_COOKIE['artist_name']);
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            echo <<< EOL
            <div class="artist-album-div">
                <div class="artist-album-area">
                    <img src='{$row["album_loc"]}' width=250px height=250px>
                    <span class="track-album track-album-a" onclick="albumNav('{$row["album_name"]}', '{$row["album_loc"]}', '{$row["artist_name"]}', 1)">
                        <p>{$row['album_name']}</p>
                    </span>
                </div>
                <div class="artist-album-tracks">
    
                <div id="datacells-heading">
                    <span class="track-number track-no">#</span>
                    <span class="track-number track-fav"></span>
                    <span class="track-title">TITLE</span>
                </div>
            EOL;
    
            $con =  OpenCon();
            if ($stmt1 = $con->prepare('SELECT tracks.track_id, tracks.track_title, tracks.track_loc, albums.album_name, albums.album_loc, artists.artist_name FROM tracks INNER JOIN albums INNER JOIN albumsxartists INNER JOIN artists on tracks.album_id = albums.album_id AND albums.album_id = albumsxartists.album_id AND albumsxartists.artist_id = artists.artist_id AND albums.album_name = ?')) {
                $stmt1->bind_param('s', $row["album_name"]);
                $stmt1->execute();
    
                $result1 = $stmt1->get_result();
    
                $count = 0;
                while ($row1 = $result1->fetch_assoc()) {
                    echo <<<EOL
                        <div class="datacells-tracks">
                        <button class="material-icons track-number track-number-a" data-count={$count} onclick="loadTrack('{$row1["track_loc"]}', '{$row1["artist_name"]}', '{$row1["track_title"]}', '{$row1["album_loc"]}', {$count})">play_circle_filled</button>
                    EOL;
    
                    $con =  OpenCon();
                    if ($stmt2 = $con->prepare("SELECT COUNT(*) FROM userxlikes where user_id = ? and track_id = ?")) {
                        $stmt2->bind_param("ii", $_SESSION["id"], $row1["track_id"]);
                        $stmt2->execute();
                        $stmt2->bind_result($found);
    
                        $stmt2->fetch();
    
                        if ($found == 0) {
                            echo <<<EOL
                        <button class="material-icons favorite favorite-a" data-id='{$row1["track_id"]}' onclick="favorite('{$row1["track_id"]}')")">favorite_border</button>
                        EOL;
                        } else {
                            echo <<<EOL
                        <button class="material-icons favorite favorite-a" data-id='{$row1["track_id"]}' onclick="favorite('{$row1["track_id"]}')")">favorite</button>
                        EOL;
                        }
                    }
                    echo <<< EOL
                        <span class="track-title track-title-a">{$row1["track_title"]}</span>
                                        <div class="dropdown">
                <button class="material-icons track-number track-addtoplaylist-a" data-id="{$row["track_id"]}" onclick="playlist('{$row["track_id"]}')">playlist_add</button>
                <div class="dropdown-content">
            EOL;

                    $con = OpenCon();

                    if ($stmt2 = $con->prepare("SELECT playlist_id, playlist_name FROM `users_playlists` WHERE user_id = ?")) {
                        $stmt2->bind_param("i", $_SESSION["id"]);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();

                        while ($row2 = $result2->fetch_assoc()) {
                            $con = OpenCon();
                            if ($stmt3 = $con->prepare("SELECT COUNT(*) FROM playlists_contents WHERE playlists_contents.user_id = ? and playlists_contents.playlist_id = ? and playlists_contents.track_id = ?")) {
                                $stmt3->bind_param("iii", $_SESSION["id"], $row2["playlist_id"], $row1["track_id"]);
                                $stmt3->execute();
                                $stmt3->bind_result($found);

                                $stmt3->fetch();
                    
                                if ($found == 0) {
                                    echo <<<EOL
                        <a class="playlist-drp" href="#" onclick="playlist('{$row1["track_id"]}', '{$row2["playlist_id"]}')">{$row2["playlist_name"]}</a>
                        EOL;
                                } else {
                                    echo <<<EOL
                        <a class="playlist-drp" href="#" onclick="playlist('{$row1["track_id"]}', '{$row2["playlist_id"]}')">{$row2["playlist_name"]}<i class="material-icons">done</i></a>
                        EOL;
                                }
                            }
                        }

                        echo <<< EOL
                        </div>
                    </div>
                </div>

            EOL;
                    }

                    EOL;
                    $count++;
                }
    
                echo <<< EOL
                </div>
            </div>
            EOL;
            }
        }
    }
    CloseCon($con);
?>
</div>
