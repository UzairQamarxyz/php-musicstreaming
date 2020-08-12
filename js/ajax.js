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

function playlist(track_id, playlist_id) {
    $.ajax({
        url: "../php/playlist.php",
        type: "POST",
        data: {
            track_id: track_id,
            playlist_id: playlist_id
        },
        success: function(data) {
            if (data == "added") {
                $(".track-addtoplaylist-a[data-id='" + track_id + "']").html("playlist_add_check")
            } else if (data == "removed") {
                alert("removed")
            }
        }
    })
}

function follow(artist_id) {
    $.ajax({
        url: "../php/follow.php",
        type: "POST",
        data: {
            id: artist_id
        },
        success: function(data) {
            if (data == "following") {
                $(".follow").addClass("unfollow")
                $(".follow").removeClass("follow")
                $(".unfollow").html("Following")
            } else if (data == "unfollowing") {
                $(".unfollow").addClass("follow")
                $(".unfollow").removeClass("unfollow")
                $(".follow").html("Follow")
            }
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
