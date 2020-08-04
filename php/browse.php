<?php
    session_start(); 
    $_SESSION['current'] = 'browse.php';
?>
<p id="datagrid-heading">Browse</p>

<!-- DATA CELLS -->
<div id="datacells-browse">

    <!-- Albums Gallery -->

    <div class="gallery-outerdiv">
        <h2 class="gallery-heading">Albums</h2>
        <div class="gallery-innerdiv">

<?php
    $servername ="localhost";
    $user ="root";
    $pass = '';
    $dbname = "project";
    $con = mysqli_connect($servername, $user, $pass, $dbname);

    $resultQ = "SELECT * FROM albums;";
    $result = mysqli_query($con, $resultQ);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $location = $row["album_loc"];
            $title = $row["album_name"];

            echo <<< EOL
            <div class="album-gallery">
                <a href="#" data-album="$title">
                    <img src="$row[album_loc]" alt="album art" width="200" height="200">
                </a>
                <div class="desc">$title</div>
            </div>
            EOL;
        }
    }

?>


        </div>
    </div>

    <!-- Artists Gallery -->

    <div class="gallery-outerdiv">
        <h2 class="gallery-heading">Artists</h2>
        <div class="gallery-innerdiv">

<?php
    $servername ="localhost";
    $user ="root";
    $pass = '';
    $dbname = "project";
    $con = mysqli_connect($servername, $user, $pass, $dbname);

    $resultQ = "SELECT * FROM artists;";
    $result = mysqli_query($con, $resultQ);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $location = $row["artist_loc"];
            $title = $row["artist_name"];

            echo <<< EOL
            <div class="album-gallery">
                <a class="browse-album" href="#">
                    <img src="$location" alt="arist" width="200" height="200">
                </a>
                <div class="desc">$title</div>
            </div>
            EOL;
        }
    }

?>
        </div>
    </div>
</div>
