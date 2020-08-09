<?php
    session_start();
    $_SESSION['current'] = 'artist.php';

    include "dbcon.php";
?>

<button class="material-icons back" onclick="$('#browse-page').click()">arrow_back_ios</button>

<div id="album-area">
<img id="album-picture" style="border-radius:50%;" src='<?=$_GET[artist_loc]?>'>
        <div id="profile">
        <p id="artist-artist-name"><?=$_GET[artist_name]?></p>
<?php
    $con = OpenCon();
    if ($stmt = $con->prepare("SELECT artist_desc FROM artists WHERE artist_name = '$_GET[artist_name]'")) {
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
    }
    echo <<< EOL
        <p id="artist-artist-desc">$row[artist_desc]</p>
    EOL;
    CloseCon($con);
?>
    </div>
</div>

<!-- DATA CELLS -->
<div id="datacells">
    <p id="datagrid-heading">Albums By <?=$_GET[artist_name]?></p>
<?php
                $con = OpenCon();
    
                if ($stmt = $con->prepare('SELECT albums.album_name,albums.album_loc FROM albums JOIN albumsxartists JOIN artists ON albums.album_id = albumsxartists.album_id AND albumsxartists.artist_id = artists.artist_id AND artists.artist_name = ?')) {
                    $stmt->bind_param('s', $_GET['artist_name']);
                    $stmt->execute();
    
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        $album_name = $row['album_name'];
                        echo <<< EOL
                        <div class="artist-album-div">
                            <div class="artist-album-area">
                                <img src='$row[album_loc]' width=250px height=250px>
                                <p>$album_name</p>
                            </div>
                            <div class="artist-album-tracks">

                            <div id="datacells-heading" style="justify-content: unset !important;">
                                <span class="track-number track-no">#</span>
                                <span class="track-number track-fav"></span>
                                <span class="track-title">TITLE</span>
                            </div>
                        EOL;

                        if ($stmt1 = $con->prepare('SELECT tracks.track_id, tracks.track_title, tracks.track_loc, albums.album_name, albums.album_loc, artists.artist_name FROM tracks INNER JOIN albums INNER JOIN albumsxartists INNER JOIN artists on tracks.album_id = albums.album_id AND albums.album_id = albumsxartists.album_id AND albumsxartists.artist_id = artists.artist_id AND albums.album_name = ?')) {
                            $stmt1->bind_param('s', $album_name);
                            $stmt1->execute();
    
                            $result1 = $stmt1->get_result();

                            $count = 0;
                            while ($row1 = $result1->fetch_assoc()) {
                                echo <<<EOL
                                <div class="datacells-tracks" style="justify-content: unset !important;">
                                <button class="material-icons track-number" data-count=$count onclick="loadTrack('$row[track_loc]', '$row[artist_name]', '$row[track_title]', '$row[album_loc]', $count)">play_circle_filled</button>
                                EOL;

                                $con =  OpenCon();
                                if ($stmt2 = $con->prepare("SELECT COUNT(*) FROM userxlikes where user_id = ? and track_id = ?")) {
                                    $stmt2->bind_param("ii", $_SESSION["id"], $row1[track_id]);
                                    $stmt2->execute();
                                    $stmt2->bind_result($found);

                                    $stmt2->fetch();
                
                                    if ($found == 0) {
                                        echo <<<EOL
                                    <button class="material-icons favorite" data-id='$row1[track_id]' onclick="favorite('$row1[track_id]')")">favorite_border</button>
                                    EOL;
                                    } else {
                                        echo <<<EOL
                                    <button class="material-icons favorite" data-id='$row1[track_id]' onclick="favorite('$row1[track_id]')")">favorite</button>
                                    EOL;
                                    }
                                }
                                echo <<< EOL
                                    <span class="track-title">$row1[track_title]</span>
                                </div>
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

<script>
</script>
