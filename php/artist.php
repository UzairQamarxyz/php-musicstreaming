<?php
    session_start();
    $_SESSION['current'] = 'artist.php';

    include "dbcon.php";
?>

<div id="album-area">
<img id="album-picture" style="border-radius:50%;" src='<?=$_COOKIE[location]?>'>
        <div id="profile">
        <p id="artist-artist-name"><?=$_COOKIE[artist_name]?></p>
    </div>
</div>

<!-- DATA CELLS -->
<div id="datacells">
<?php
                $con = OpenCon();
    
                if ($stmt = $con->prepare('Select albums.album_name,albums.album_loc from albums JOIN albumsxartists JOIN artists on albums.album_id = albumsxartists.album_id and albumsxartists.artist_id = artists.artist_id and artists.artist_name = ?')) {
                    $stmt->bind_param('s', $_COOKIE['artist_name']);
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
                                <span class="track-number">#</span>
                                <span class="track-title">TITLE</span>
                            </div>
                        EOL;

                        if ($stmt1 = $con->prepare('SELECT tracks.track_title, tracks.track_loc, albums.album_name, albums.album_loc, artists.artist_name FROM tracks INNER JOIN albums INNER JOIN albumsxartists INNER JOIN artists on tracks.album_id = albums.album_id AND albums.album_id = albumsxartists.album_id AND albumsxartists.artist_id = artists.artist_id AND albums.album_name = ?')) {
                            $stmt1->bind_param('s', $album_name);
                            $stmt1->execute();
    
                            $result1 = $stmt1->get_result();

                            while ($row1 = $result1->fetch_assoc()) {
                                echo <<<EOL
                                <div class="datacells-tracks" style="justify-content: unset !important;">
                                    <button class="material-icons track-number" onclick="loadTrack('$row1[track_loc]','$row1[artist_name]','$row1[track_title]', '$row[album_loc]')">play_circle_filled</button>
                                    <span class="track-title">$row1[track_title]</span>
                                </div>
                            EOL;
                            }
 
                            echo <<< EOL
                            </div>
                        </div>
                        EOL;
                        }
                    }
                }
            ?>
</div>

<script>
</script>
