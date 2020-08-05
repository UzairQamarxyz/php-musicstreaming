<script>
createCookie("album_loc", location, "10");
function createCookie(name, value, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}
</script>
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
                    $_SESSION['album_name'] = $row["album_name"];
                    $_SESSION['album_loc'] = $row["album_loc"];

                    echo <<< EOL
                    <div class="album-gallery">
                        <a class="browse-album" href="#">
                            <img src="$row[album_loc]" alt="album art" width="200" height="200">
                        </a>
                    <div class="desc">$_SESSION[album_name]</div>
                    </div>
                    EOL;
                }
            }
            
            function loadAlbum($album_name)
            {
                $_SESSION['album_name'] = $album_name;
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
            $_SESSION['artist_name'] = $row["artist_name"];
            $_SESSION['artist_loc'] = $row["artist_loc"];

            echo <<< EOL
            <div class="album-gallery">
                <a class="browse-artist" href="#">
                    <img src="$_SESSION[artist_loc]" alt="arist" width="200" height="200">
                </a>
                <div class="desc">$_SESSION[artist_name]</div>
            </div>
            EOL;
        }
    }
?>

        </div>
    </div>
</div>
<script>
$(".browse-album").click(function (){
    var title = $(".browse-album").attr("data-album-name");
    var location = $(".browse-album").attr("data-album-location");


    $('#datagrid').load('album.php')
})


</script>
