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

    $resultQ = "SELECT * FROM tracks;";
    $result = mysqli_query($con, $resultQ);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo
            '<div class="datacells-tracks">';

            $location = $row["track_loc"];
            $artist = $row["track_artist"];
            $title = $row["track_title"];
                
            echo <<<EOL
            <button class="material-icons track-number" onclick="loadTrack('$location','$artist','$title')">play_circle_filled</button>
            EOL;

            echo'
            <span class="track-title">'.$row["track_title"].'</span>
            <span class="track-artist">'.$row["track_artist"].'</span>
            <span class="track-album">'.$row["track_album"].'</span>
        </div>';
        }
    }

?>
</div>
