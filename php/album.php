<?php
    session_start(); 
    $_SESSION['current'] = 'album.php';
?>
    <div id="album-area">
        <img id="album-picture" src="../assets/banner.jpg">
        <div id="profile">
            <p id="album-name">Album Name</p>
            <p id="username">Artist Name</p>
        </div>
    </div>
    <p id="datagrid-heading">Album Name</p>

    <!-- DATA CELLS -->
    <div id="datacells">
        <div id="datacells-heading">
            <span class="track-number">#</span>
            <span class="track-title">TITLE</span>
            <span class="track-artist">ARTIST</span>
            <span class="track-album">ALBUM</span>
            <span class="track-duration">L.</span>
        </div>
        <div class="datacells-tracks">
            <span class="track-number">1</span>
            <span class="track-title">Storm</span>
            <span class="track-artist">Godspeed You! Black Emperor</span>
            <span class="track-album">Lift Your Skinny Fists Like Antennas to Heaven</span>
            <span class="track-duration">22:32</span>
        </div>
        <div class="datacells-tracks">
            <span class="track-number">2</span>
            <span class="track-title">Power of Persuasion</span>
            <span class="track-artist">Oneohtrix Point Never</span>
            <span class="track-album">Replica</span>
            <span class="track-duration">03:28</span>
        </div>
        <div class="datacells-tracks">
            <span class="track-number">3</span>
            <span class="track-title">Sleep Dealer</span>
            <span class="track-artist">Oneohtrix Point Never</span>
            <span class="track-album">Replica</span>
            <span class="track-duration">03:10</span>
        </div>
    </div>
