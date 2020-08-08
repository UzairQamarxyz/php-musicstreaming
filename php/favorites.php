<?php
    session_start();
    $_SESSION['current'] = 'favorites.php';

    include "dbcon.php";
?>

<p id="datagrid-heading">Your Favorites</p>

<!-- DATA CELLS -->
<div id="datacells">
    <div id="datacells-heading">
        <span class="track-number track-no">#</span>
        <span class="track-number track-fav"></span>
        <span class="track-title">TITLE</span>
        <span class="track-artist">ARTIST</span>
        <span class="track-album">ALBUM</span>
    </div>
<?php
    $con = OpenCon();

    if ($stmt = $con->prepare("SELECT tracks.track_title, track_loc,albums.album_name, album_loc,artists.artist_name from tracks JOIN userxlikes JOIN albums JOIN albumsxartists JOIN artists on tracks.track_id = userxlikes.track_id and tracks.album_id = albums.album_id and albums.album_id = albumsxartists.album_id and albumsxartists.artist_id = artists.artist_id and userxlikes.user_id = ?")) {
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
    
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo <<<EOL
            <div class="datacells-tracks">
                <button class="material-icons track-number" onclick="loadTrack('$row[track_loc]', '$row[artist_name]', '$row[track_title]', '$row[album_loc]')">play_circle_filled</button>
                <button class="material-icons favorite" data-id='$row[track_id]' onclick="favorite('$row[track_id]')")">favorite_border</button>
                <span class="track-title">$row[track_title]</span>
                <span class="track-artist">$row[artist_name]</span>
                <span class="track-album">$row[album_name]</span>
            </div>
            EOL;
        }
    }

?>
</div>
