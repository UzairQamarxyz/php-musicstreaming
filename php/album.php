<?php
    session_start();
    $_SESSION['current'] = 'album.php';
?>

<div id="album-area">
    <img id="album-picture" src="<?=$_COOKIE[location]?>">
        <div id="profile">
            <p id="album-album-name"><?=$_COOKIE[album_name]?></p>
            <p id="album-artist-name"><?=$_COOKIE[artist_name]?></p>
        </div>
    </div>
    
    <!-- DATA CELLS -->
    <div id="datacells">
        <div id="datacells-heading">
            <span class="track-number">#</span>
            <span class="track-title">TITLE</span>
            <span class="track-artist">ARTIST</span>
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
    
                if ($stmt = $con->prepare('SELECT tracks.track_title, tracks.track_loc, albums.album_name, albums.album_loc, artists.artist_name FROM tracks INNER JOIN albums INNER JOIN albumsxartists INNER JOIN artists on tracks.album_id = albums.album_id AND albums.album_id = albumsxartists.album_id AND albumsxartists.artist_id = artists.artist_id AND albums.album_name = ?')) {
                    $stmt->bind_param('s', $_COOKIE['album_name']);
                    $stmt->execute();
    
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo <<< EOL
                        <div class="album-gallery">
                            <a class="browse-album" href="#">
                                <img class="browse-album-select" src="$location" alt="album art" onclick="albumNav('$album_name','$artist_name' ,'$location', '1')" width="200" height="200">
                            </a>
                        <div class="desc">$row[album_name]</div>
                        </div>
                    EOL;
                    }
                }
            ?>
    
        </div>
</div>
