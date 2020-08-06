<?php
    session_start();
    $_SESSION['current'] = 'album.php';
?>

<div id="album-area">
    <img id="album-picture" src="<?=$_COOKIE[location]?>">
        <div id="profile">
            <p id="album-name"><?=$_COOKIE[album_name]?></p>
            <p><?=$_COOKIE[artist_name]?></p>
        </div>
    </div>
    
    <!-- DATA CELLS -->
    <div id="datacells">
        <div id="datacells-heading">
            <span class="track-number">#</span>
            <span class="track-title">TITLE</span>
            <span class="track-artist">ARTIST</span>
            <span class="track-album">ALBUM</span>
        </div>
    
        <!-- Albums Gallery -->
    
            <?php
                $DATABASE_HOST = 'localhost';
                $DATABASE_USER = 'root';
                $DATABASE_PASS = '';
                $DATABASE_NAME = 'project';
                $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    
                if (mysqli_connect_errno()) {
                    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                }
    
                if ($stmt = $con->prepare('SELECT tracks.track_title, tracks.track_loc, albums.album_name, artists.artist_name FROM tracks INNER JOIN albums INNER JOIN albumsxartists INNER JOIN artists on tracks.album_id = albums.album_id AND albums.album_id = albumsxartists.album_id AND albumsxartists.artist_id = artists.artist_id AND albums.album_name = ?')) {
                    $stmt->bind_param('s', $_COOKIE['album_name']);
                    $stmt->execute();
    
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo <<<EOL
                            <div class="datacells-tracks">
                                <button class="material-icons track-number" onclick="loadTrack('$row[track_loc]','$row[artist_name]','$row[track_title]')">play_circle_filled</button>
                                <span class="track-title">$row[track_title]</span>
                                <span class="track-artist">$row[artist_name]</span>
                                <span class="track-album">$row[album_name]</span>
                            </div>
                        EOL;
                    }
                }
            ?>
    
        </div>
</div>
