<?php
    session_start();
    $_SESSION['current'] = 'artist.php';
?>

<div id="album-area">
<img id="album-picture" style="border-radius:50%;" src='<?=$_COOKIE[location]?>'>
        <div id="profile">
        <p id="artist-artist-name"><?=$_COOKIE[artist_name]?></p>
    </div>
</div>

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

    $resultQ = "SELECT * FROM artists;";
    $result = mysqli_query($con, $resultQ);

?>
    <div class="datacells-tracks">
        <span class="track-number">1</span>
        <span class="track-title">Storm</span>
        <span class="track-artist">Godspeed You! Black Emperor</span>
        <span class="track-album">Lift Your Skinny Fists Like Antennas to Heaven</span>
        <span class="track-duration">22:32</span>
    </div>
</div>

<script>
</script>
