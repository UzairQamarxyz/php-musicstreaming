<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<h1 style="margin: 30px">Your Playlists</h1>
<div id="playlists-playlist-div">
<?php
session_start();
$_SESSION['current'] = 'playlists.php';
include "dbcon.php";

$con = OpenCon();

if ($stmt = $con->prepare("SELECT users_playlists.playlist_id, users_playlists.playlist_name FROM users_playlists WHERE users_playlists.user_id = ?")) {
    $stmt->bind_param("i", $_SESSION["id"]);
    $stmt->execute();

    $result = $stmt->get_result();
    $count=1;
    while ($row=$result->fetch_assoc()) {
        echo <<< EOL
        <div class="playlists-playlist-name-div">
            <span class="playlists-playlist-name">{$count}. </span>
            <p class="playlists-playlist-name">{$row["playlist_name"]}</p>
        </div>
        EOL;
        $count++;
    }
}
?>
<form id="addplaylist-form" method="POST">
    <div id="playlists-form">
        <span id="playlists-playlist-count"><?=$count?>. </span>
        <input type="text" id="addplaylist-text" name="playlist-form-text" placeholder="Enter Playlist Name">
    </div>
    <input id="playlists-playlist-add" type="submit" value="Add" onclick="insertplaylist()">
</form>

<button id="add-playlist-circle" class="material-icons" onclick="addPlaylist()">add_circle</button>
</div>
