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
        type: "GET",
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
        type: "GET",
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
    if (!email) {
        $('#et').html("Please Enter an Email")
    } else {
        $.post("./submit.php", {
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                email: email
            },

            function(data) {
                $('#et').html(data);
            });
    }
}

function passwordUpdate() {
    var password = $("#psw").val()

    if (!password) {
        $('#pt').html("Please Enter a Password")
    } else {
        $.post("./submit.php", {
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                password: password
            },

            function(data) {
                $('#et').html(data);
            });
    }
}

function upload(fdata) {
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

$('#profile-banner').on('click', function(event) {
    // compare the element clicked (event.target) with the
    // element that has the click attached (this)
    if (event.target == this) {
        $("#change-banner").click()
    } else
        return;
})

$('#settings-pfp').on('click', function(event) {
    // compare the element clicked (event.target) with the
    // element that has the click attached (this)
    if (event.target == this) {
        $("#change-pfp").click()
    } else
        return;
})
