var playpause = document.getElementById("playpause")

function initProgressBar() {
    var player = document.getElementById('player');
    var length = player.duration
    var current_time = player.currentTime;

    // calculate total length of value
    var totalLength = calculateTotalValue(length)
    document.getElementById("end-time").innerHTML = totalLength;

    // calculate current value time
    var currentTime = calculateCurrentValue(current_time);
    document.getElementById("start-time").innerHTML = currentTime;

    var progressbar = document.getElementById('seek-obj');
    progressbar.value = (player.currentTime / player.duration);
    progressbar.addEventListener("click", seek);

    if (player.currentTime == player.duration) {
        document.getElementById('playpause').className = "material-icons operator";
        $("#playpause").addClass("paused")
        $('#playpause').html('play_arrow');
        player.pause()

    }

    function seek(event) {
        var percent = event.offsetX / this.offsetWidth;
        player.currentTime = percent * player.duration;
        progressbar.value = percent / 100;
    }
};

function calculateTotalValue(length) {
    var minutes = Math.floor(length / 60),
        seconds_int = length - minutes * 60,
        seconds_str = seconds_int.toString(),
        seconds = seconds_str.substr(0, 2),
        time = minutes + ':' + seconds

    return time;
}

function calculateCurrentValue(currentTime) {
    var current_hour = parseInt(currentTime / 3600) % 24,
        current_minute = parseInt(currentTime / 60) % 60,
        current_seconds_long = currentTime % 60,
        current_seconds = current_seconds_long.toFixed(),
        current_time = (current_minute < 10 ? "0" + current_minute : current_minute) + ":" + (current_seconds < 10 ? "0" + current_seconds : current_seconds);

    return current_time;
}

function play() {
    current = $("#playpause").attr("data-current")

    if (playpause.classList.contains("paused")) {
        $("#playpause").removeClass("paused")
        $('#playpause').html('pause');
        $(".track-number[data-count='" + current + "']").html("pause_circle_filled")
        player.play()
    } else if (!playpause.classList.contains("paused")) {
        $("#playpause").addClass("paused")
        $('#playpause').html('play_arrow');
        $(".track-number[data-count='" + current + "']").html("play_circle_filled")
        player.pause()
    }
}

function loadTrack(track_location, artist, title, album_loc, play_count) {
    if ($("source").prop("src") !== track_location) {
        $("source").prop("src", track_location)
        $("#playpause").attr("data-current", play_count)
        document.getElementById("player-artist").innerHTML = artist + " - "
        document.getElementById("player-title").innerHTML = title

        $("#album-art").attr('src', album_loc)

        player.load()
        prev_count = play_count
    }

    play();
}

function playNext() {
    if ($("#shuffle").hasClass("toggled")) {
        rando = Math.floor(Math.random() * $(".track-number[data-count]").length) + 1
    }

    // get current count
    current = $("#playpause").attr("data-current")

    // pause current song
    $("#playpause").addClass("paused")
    $('#playpause').html('play_arrow');
    $(".track-number[data-count='" + current + "']").html("play_circle_filled")
    player.pause()

    if (typeof rando !== "undefined") {
        next = rando
    } else {
        next = current
    }

    // if already on last track then loop to start 
    if (next == $(".track-number[data-count]").length - 1) {
        next = -1
    }

    // click next entry
    $(".track-number[data-count='" + ++next + "']").click()
}

function playPrev() {
    if ($("#shuffle").hasClass("toggled")) {
        rando = Math.floor(Math.random() * $(".track-number[data-count]").length) + 1
    }

    // get current count
    prev = $("#playpause").attr("data-current")

    // pause current song
    $("#playpause").addClass("paused")
    $('#playpause').html('play_arrow');
    $(".track-number[data-count='" + current + "']").html("play_circle_filled")
    player.pause()

    if (typeof rando !== "undefined") {
        prev = rando
    } else {
        prev = current
    }

    // if already on first track then loop to last
    if (prev == 0) {
        prev = $(".track-number[data-count]").length
    }

    // click next entry
    $(".track-number[data-count='" + --prev + "']").click()
}

$("#repeat").on("click", function(e) {
    $("#repeat").toggleClass("toggled")

    if ($("#player").prop('loop') == false) {
        $("#player").prop('loop', true);
    } else {
        $("#player").prop('loop', false);
    };

    e.preventDefault();
})

$("#shuffle").on("click", function(e) {
    $("#shuffle").toggleClass("toggled")

    e.preventDefault();
})

$("#player").on("ended", function() {
    if ($("#shuffle").hasClass("toggled")) {
        rando = Math.floor(Math.random() * $(".track-number[data-count]").length) + 1
        playNext()
        console.log(rando)
    }
})
