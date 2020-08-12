function albumNav(album_name, album_loc, artist_name, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = "album_name=" + album_name + expires + "; path=/";
    document.cookie = "album_loc=" + album_loc + expires + "; path=/";
    document.cookie = "artist_name=" + artist_name + expires + "; path=/";


    $('#datagrid').load('album.php')
}

function artistNav(artist_id, artist_name, artist_loc, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = "artist_id=" + artist_id+ expires + "; path=/";
    document.cookie = "artist_name=" + artist_name + expires + "; path=/";
    document.cookie = "artist_loc=" + artist_loc + expires + "; path=/";

    $('#datagrid').load('artist.php')
}

function clearSearch() {
    $("#search-text").val("")
    $("#search-text").keyup()
}

$("#menu").on("click", function() {
    $("#grid-container").toggleClass("menu-open");
    $('#sidebar').toggleClass("sidebar-open")
})
