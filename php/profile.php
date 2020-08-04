<?php session_start(); ?>
<div id="profile-banner" style="background-image: linear-gradient(rgb(5 25 35 / 0%), rgb(25 25 34)), url(<?=$_SESSION['banner']?>);">
    <div id="page-profile">
        <img id="profile-picture" src=<?=$_SESSION['pfp'];?> onerror=this.src="../assets/pfps/default.png">
        <p id="username"><?=$_SESSION['name']?></p>
    </div>
</div>
<p id="datagrid-heading">Your Uploads</p>

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
