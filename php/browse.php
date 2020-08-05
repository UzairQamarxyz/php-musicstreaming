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
                    $name = $row["album_name"];
                    $location = $row["album_loc"];
                    echo <<< EOL
                    <div class="album-gallery">
                        <a class="browse-album" href="#">
                            <img src="$location" alt="album art" onclick="createCookie('$name', '$location', '1')" width="200" height="200">
                        </a>
                    <div class="desc">$name</div>
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

function createCookie(title, location, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = "name=" + title + expires + "; path=/";
  document.cookie = "location=" + location + expires + "; path=/";

  $('#datagrid').load('album.php')


}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

</script>
