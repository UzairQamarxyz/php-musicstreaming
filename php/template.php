<!DOCTYPE HTML>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="../styles/streams.css">
    <link rel="stylesheet" type="text/css" href="../styles/album.css">
    <link rel="stylesheet" type="text/css" href="../styles/profile.css">
    <link rel="stylesheet" type="text/css" href="../styles/browse.css">

    <link rel="stylesheet" type="text/css" href="../styles/universal/grid.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/player.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/topbar.css">

    <script type="text/javascript" src="../js/player.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


</head>

<body>
    <div class="grid-container">
        <h1 id="site-name">SITE</h1>

        <div id="searchbar">
            <i id="search-icon" class="material-icons operator">search</i>
            <input id="search-box" type="text" placeholder="Search Something..." />
        </div>

        <div id="profile-bar">
            <span id="banner-username"><b>Username</b></span>
            <img id="pfp" src="../assets/pfp.png" width="35" height="35">
        </div>

        <div id="sidebar">
            <div id="list-div">
                <ul id="list">
                    <li><a id="streams-page" href="#"><i href="" class="material-icons">audiotrack</i><b>Your Stream</b></a></li>
                    <li><a id="browse-page" href="#"><i href="" class="material-icons">view_list</i><b>Browse</b></a></li>
                    <li><a id="favorite-page" href="#"><i href="" class="material-icons">favorite</i><b>Favorites</b></a></li>
                </ul>
            </div>
            <img id="album-art" src="../assets/album.jpg" />
        </div>

        <div id="datagrid">
<?php
    $dir = '../assets/songs/songs/';
    $files = scandir($dir, 0);
    for ($i = 2; $i < count($files); $i++) {
    print $files[$i]."<br>";
}
?>
        </div>

        <div id="player-div">
            <audio id="player" ontimeupdate="initProgressBar()">
                <source src="../assets/song.mp3" type="audio/mp3">
            </audio>
            <div id="controls">
                <button id="prev" class="material-icons operator">skip_previous</button>
                <button id="playpause" class="material-icons operator paused" onclick="play()">play_arrow</button>
                <button id="next" class="material-icons operator">skip_next</button>
            </div>
            <div id="player-trackbox">
                <div id="player-info">
                    <span id="player-artist">Dawn Wall</span>
                    <p> - </p>
                    <span id="player-title">Mantis</span>
                </div>
                <div id="timestamps">
                    <small id="start-time">00:00</small>
                    <progress id="seek-obj" value="0" max="1"></progress>
                    <small id="end-time">00:00</small>
                </div>
            </div>

        </div>
<script>
$('#pfp').click(function(){
    $('#datagrid').load('profile.php');
})
$('#streams-page').click(function(){
    $('#datagrid').load('streams.php');
})
$('#browse-page').click(function(){
    $('#datagrid').load('browse.php');
})
$('#favorite-page').click(function(){
    $('#datagrid').load('favorite.php');
})
</script>
</body>

</html>
