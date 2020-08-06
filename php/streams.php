<?php
    session_start();
    $_SESSION['current'] = 'streams.php';
?>
<p id="datagrid-heading">Your Stream</p>

<!-- DATA CELLS -->
<div id="datacells">
    <div id="datacells-heading">
        <span class="track-number">#</span>
        <span class="track-title">TITLE</span>
        <span class="track-artist">ARTIST</span>
        <span class="track-album">ALBUM</span>
    </div>
<?php
    $servername ="localhost";
    $user ="root";
    $pass = '';
    $dbname = "project";
    $con = mysqli_connect($servername, $user, $pass, $dbname);

    $resultQ = "SELECT tracks.track_id,tracks.track_title, albums.album_name, albums.album_loc, artists.artist_name, tracks.track_loc from tracks INNER JOIN albums INNER JOIN artists WHERE tracks.album_id = albums.album_id and tracks.artist_id = artists.artist_id;";
    $result = mysqli_query($con, $resultQ);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
                
            echo <<<EOL
            <div class="datacells-tracks">
                <button class="material-icons track-number" onclick="loadTrack('$row[track_loc]','$row[artist_name]','$row[track_title]', '$row[album_loc]')">play_circle_filled</button>
                <span class="track-title">$row[track_title]</span>
                <span class="track-artist">$row[artist_name]</span>
                <span class="track-album">$row[album_name]</span>
            </div>
            EOL;
        }
    }

?>
</div>
