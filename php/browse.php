<?php
    session_start();
    $_SESSION['current'] = 'browse.php';

    include "dbcon.php";
?>
<p id="datagrid-heading">Browse</p>

<!-- DATA CELLS -->
<div id="datacells-browse">
    <!-- Artists Gallery -->

    <div class="gallery-outerdiv">
        <h2 class="gallery-heading">Artists</h2>
        <div class="gallery-innerdiv">

<?php
    $con = OpenCon();

    if ($stmt = $con->prepare("SELECT artist_name, artist_loc FROM artists;")) {
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo <<< EOL
            <div class="album-gallery">
                <a class="browse-artist" href="#">
                    <img src='$row[artist_loc]' alt="arist" width="200" height="200" onclick="artistNav('{$row["artist_name"]}', '{$row["artist_loc"]}', 1)" style="border-radius: 50%;">
                </a>
                <div class="desc">{$row["artist_name"]}</div>
            </div>
            EOL;
        }
    }
?>

        </div>
    </div>


    <!-- Albums Gallery -->

    <div class="gallery-outerdiv">
        <h2 class="gallery-heading">Albums</h2>
        <div class="gallery-innerdiv">

        <?php
            $con = OpenCon();

            if ($stmt = $con->prepare("SELECT albums.album_name, albums.album_loc, artists.artist_name from albums JOIN albumsxartists JOIN artists on albums.album_id = albumsxartists.album_id and albumsxartists.artist_id = artists.artist_id")) {
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo <<< EOL
                    <div class="album-gallery">
                        <a class="browse-album" href="#">
                            <img class="browse-album-select" src="{$row["album_loc"]}" alt="album art" onclick="albumNav('{$row["album_name"]}', '{$row["album_loc"]}', '{$row["artist_name"]}', 1)" width="200" height="200">
                        </a>
                    <div class="desc">${row["album_name"]}</div>
                    </div>
                    EOL;
                }
            }
        ?>

        </div>
    </div>

</div>
<script>

function albumNav(album_name, album_loc, artist_name, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = "album_name=" + album_name + expires + "; path=/";
  document.cookie = "album_loc=" + album_loc + expires + "; path=/";
  document.cookie = "artist_name=" + album_name + expires + "; path=/";

  $('#datagrid').load('album.php')
}

function artistNav( artist_name, artist_loc, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = "artist_name=" + artist_name + expires + "; path=/";
  document.cookie = "artist_loc=" + artist_loc + expires + "; path=/";

  $('#datagrid').load('artist.php')
}

</script>
