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
        document.getElementById('playpause').className = "";
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

function play(location) {
    player.load()
    if (playpause.classList.contains("paused")) {
        $("#playpause").removeClass("paused")
        $('#playpause').html('pause');
        player.play()
    } else if (!playpause.classList.contains("paused")) {
        $("#playpause").addClass("paused")
        $('#playpause').html('play_arrow');
        player.pause()
    }
}

function loadTrack(location, artist, title) {
    console.log(location)
    $("source").prop("src", location)

    document.getElementById("player-artist").innerHTML = artist + " - "
    document.getElementById("player-title").innerHTML = title 

    if (!playpause.classList.contains("paused")) {
        $("#playpause").addClass("paused")
        $('#playpause').html('play_arrow');
        player.pause()
    }

    player.load()
    play()
}
