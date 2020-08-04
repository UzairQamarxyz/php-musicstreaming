<!DOCTYPE HTML>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="../styles/streams.css">
    <link rel="stylesheet" type="text/css" href="../styles/album.css">
    <link rel="stylesheet" type="text/css" href="../styles/profile.css">
    <link rel="stylesheet" type="text/css" href="../styles/browse.css">
    <link rel="stylesheet" type="text/css" href="../styles/settings.css">

    <link rel="stylesheet" type="text/css" href="../styles/universal/grid.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/player.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../styles/universal/topbar.css">

    <script type="text/javascript" src="../js/player.js" defer></script>
    <script type="text/javascript" src="../js/verification.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="typeahead.min.js"></script>

</head>

<body>
<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit;
    }

    $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

    if ($pageWasRefreshed) {
        //do something because page was refreshed;
    } else {
        //do nothing;
    }
?>
<div class="grid-container">
    <h1 id="site-name">SITE</h1>

    <div id="searchbar">
        <i id="search-icon" class="material-icons operator">search</i>
        <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Type your Query" />
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
            </ul>
        </div>
        <img id="album-art" src="../assets/album.jpg" />
    </div>

    <div id="datagrid">

    </div>

    <div id="player-div">
        <audio id="player" ontimeupdate="initProgressBar()">
            <source src="" type="audio/mp3">
        </audio>
        <div id="controls">
            <button id="prev" class="material-icons operator">skip_previous</button>
            <button id="playpause" class="material-icons operator paused" onclick="play()">play_arrow</button>
            <button id="next" class="material-icons operator">skip_next</button>
        </div>
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
 </div>
<script>

$('#datagrid').load('<?=$_SESSION['current'];?>');

$('#drp-profile').click(function(){
    <?php $_SESSION['current'] = 'profile.php' ?>
    $('#datagrid').load('<?=$_SESSION['current'];?>');
})
$('#settings').click(function(){
    <?php $_SESSION['current'] = 'settings.php' ?>
    $('#datagrid').load('<?=$_SESSION['current'];?>');
})
$('#streams-page').click(function(){
    <?php $_SESSION['current'] = 'streams.php' ?>
    $('#datagrid').load('<?=$_SESSION['current'];?>');
})
$('#browse-page').click(function(){
    <?php $_SESSION['current'] = 'browse.php' ?>
    $('#datagrid').load('<?=$_SESSION['current'];?>');
})
$('#favorite-page').click(function(){
    <?php $_SESSION['current'] = 'favorite.php' ?>
    $('#datagrid').load('<?=$_SESSION['current'];?>');
})
</script>
</body>

</html>
