<!DOCTYPE HTML>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="../styles/streams.css">
    <link rel="stylesheet" type="text/css" href="../styles/album.css">
    <link rel="stylesheet" type="text/css" href="../styles/artist.css">
    <link rel="stylesheet" type="text/css" href="../styles/profile.css">
    <link rel="stylesheet" type="text/css" href="../styles/browse.css">
    <link rel="stylesheet" type="text/css" href="../styles/settings.css">
    <link rel="stylesheet" type="text/css" href="../styles/uploadsongs.css">

    <link rel="stylesheet" type="text/css" href="../styles/universal/grid.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/player.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/topbar.css">

<!-- MEDIA QUERIES
    <link rel="stylesheet" media='screen and (min-width: 140px) and (max-width: 360px) and (-webkit-min-device-pixel-ratio: 1)' href="../styles/universal/phone.css"/>
    <link rel="stylesheet" media='screen and (min-width: 361px) and (max-width: 1024px) and (-webkit-min-device-pixel-ratio: 1)' href="../styles/universal/tablet.css"/>
 -->
    <script type="text/javascript" src="../js/other.js" defer></script>
    <script type="text/javascript" src="../js/player.js" defer></script>
    <script type="text/javascript" src="../js/ajax.js" defer></script>
    <script type="text/javascript" src="../js/verification.js" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>
<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }
?>
<div id="grid-container">
    <div id="site-name">
        <h1>SITE</h1>
        <button id="menu" class="material-icons menu" style="display:none;">menu</button>
    </div>

    <div id="searchbar">
        <i id="search-icon" class="material-icons operator">search</i>
        <input type="text" id="search-text" autocomplete="off" spellcheck="false" placeholder="Type your Query" />
        <i id="search-icon" class="material-icons operator" onclick="clearSearch()">close</i>
    </div>

    <div id="profile-bar">
    <span id="banner-username"><b><?=$_SESSION['name']?></b></span>
    <div class="dropdown">
        <img id="pfp" class="drpdn" src=<?=$_SESSION['pfp'];?> width="35" height="35" onerror=this.src="../assets/pfps/default.png">
            <div class="dropdown-content">
                <a id="drp-profile" href="#">Profile</a>
                <a id="settings" href="#">Settings</a>
                <a id="logout" href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div id="sidebar">
        <div id="list-div">
            <ul id="list">
                <li><a id="streams-page" href="#"><i href="" class="material-icons side-icons">audiotrack</i><b>Your Stream</b></a></li>
                <li><a id="browse-page" href="#"><i href="" class="material-icons side-icons">view_list</i><b>Browse</b></a></li>
                <li><a id="favorite-page" href="#"><i href="" class="material-icons side-icons">favorite</i><b>Favorites</b></a></li>
                <li><a id="playlists-page" href="#"><i href="" class="material-icons side-icons">queue_music</i><b>Playlists</b></a></li>
            </ul>
        </div>
        <img id="album-art" src="" />
    </div>

    <div id="datagrid">

    </div>

    <div id="controls">
        <button id="prev" class="material-icons operator" onclick="playPrev()">skip_previous</button>
        <button id="playpause" class="material-icons operator paused" data-current="" onclick="play()">play_arrow</button>
        <button id="next" class="material-icons operator" onclick="playNext()">skip_next</button>
    </div>
    <div id="player-div">
        <audio id="player" ontimeupdate="initProgressBar()">
            <source src="" type="audio/mp3">
        </audio>

        <div id="player-trackbox">
            <div id="player-info">
                <span id="player-artist"></span>
                <span id="player-title"></span>
            </div>
            <div id="timestamps">
                <small id="start-time">00:00</small>
                <progress id="seek-obj" value="0" max="1"></progress>
                <small id="end-time">00:00</small>
            </div>
        </div>
    </div>
    
    <div id="extra-controls">
        <button id="repeat" class="material-icons operator toggle-buttons">repeat_one</button>
        <button id="shuffle" class="material-icons operator toggle-buttons">shuffle</button>
    </div>
 </div>
<script>

$('#datagrid').load('<?=$_SESSION['current'];?>')
    $("#list li a").removeClass("active")
    $('#streams-page').addClass("active") 

$('#drp-profile').click(function(){
    $('#datagrid').load('profile.php')
})
$('#settings').click(function(){
    $('#datagrid').load('settings.php')
})
$('#streams-page').click(function(){
    $('#datagrid').load('streams.php')
    $("#list li a").removeClass("active")
    $('#streams-page').addClass("active") 
})
$('#browse-page').click(function(){
    $('#datagrid').load('browse.php')
    $("#list li a").removeClass("active")
    $('#browse-page').addClass("active") 
})
$('#favorite-page').click(function(){
    $('#datagrid').load('favorites.php')
    $("#list li a").removeClass("active")
    $('#favorite-page').addClass("active") 
})
$('#playlists-page').click(function(){
    $('#datagrid').load('playlists.php')
    $("#list li a").removeClass("active")
    $('#playlists-page').addClass("active") 
})

$("#search-text").on("keyup", function() {
    var searched_item = $(this).val();
    if (!searched_item) {
        $("#datagrid").load('<?=$_SESSION['current']?>')
    } else {
        $.ajax({
            url: "search.php",
            type: "POST",
            data: {
                search: searched_item
            },
            success: function(data) {
                $("#datagrid").html(data);
            }
        })
    }
});

</script>
</body>

</html>
