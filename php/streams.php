<p id="datagrid-heading">Your Stream</p>

<!-- DATA CELLS -->
<div id="datacells">
    <div id="datacells-heading">
        <span class="track-number">#</span>
        <span class="track-title">TITLE</span>
        <span class="track-artist">ARTIST</span>
        <span class="track-album">ALBUM</span>
        <span class="track-duration">L.</span>
    </div>
<?php
    $servername ="localhost";
    $user ="root";
    $pass = '';
    $dbname = "project";
    $con = mysqli_connect($servername, $user, $pass, $dbname);

    $dbId = mysqli_query("SELECT track_id FROM tracks LIMIT 1;");
    $dbTitle = mysqli_query("SELECT track_title FROM tracks LIMIT 1;");
    $dbArtist = mysqli_query("SELECT track_artist FROM tracks LIMIT 1;");
    $dbAlbum = mysqli_query("SELECT track_album FROM tracks LIMIT 1;");

    $resultQ = "SELECT * FROM tracks;";
    $result = mysqli_query($con, $resultQ);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="datacells-tracks">
            <span class="track-number" onclick="play()">'.$row["track_id"].'</span>
            <span class="track-title">'.$row["track_title"].'</span>
            <span class="track-artist">'.$row["track_artist"].'</span>
            <span class="track-album">'.$row["track_album"].'</span>
            <span class="track-duration">22:32</span>
        </div>';
        }
    }

?>
</div>
