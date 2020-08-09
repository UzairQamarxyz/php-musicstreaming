function favorite(track_id) {
    $.ajax({
        url: "../php/favorite.php",
        type: "POST",
        data: {
            id: track_id
        },
        success: function(data) {
            if (data == "LIKED") {
                $(".favorite[data-id='" + track_id + "']").html("favorite")
            } else if (data == "DISLIKED") {
                $(".favorite[data-id='" + track_id + "']").html("favorite_border")
            }
        }
    })
}

function albumNav(album_name, artist_name, album_loc) {
    $.ajax({
        url: "./album.php",
        type: "POST",
        data: {
            album_name: album_name,
            artist_name: artist_name,
            album_loc: album_loc
        },
        success: function(data) {
            $("#datagrid").html(data)
        }
    })
}

function artistNav(artist_name, artist_loc) {
    $.ajax({
        url: "./artist.php",
        type: "POST",
        data: {
            artist_name: artist_name,
            artist_loc: artist_loc
        },
        success: function(data) {
            $("#datagrid").html(data)
        }
    })
}

function emailUpdate() {
    var email = $("#email").val()

    $.post("./submit.php", {
            type: "POST",
            contentType: false,
            cache: false,
            processData: false,
            email: email
        },

        function(data) {
            $('#results').html(data);
            $('#form-settings')[0].reset();
        });
}

function passwordUpdate() {
    var password = $("#psw").val()

    $.post("./submit.php", {
            type: "POST",
            contentType: false,
            cache: false,
            processData: false,
            password: password
        },

        function(data) {
            $('#results').html(data);
            $('#form-settings')[0].reset();
        });
}

function upload(fdata) {
    alert(fdata)
    $.ajax({
        url: "./upload.php",
        type: "POST",
        data: new FormData(fdata),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $("#datagrid").html(data)
        }
    });
}
