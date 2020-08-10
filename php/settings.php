<?php
    session_start();
    $_SESSION['current'] = 'settings.php';
?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script type="text/javascript" src="../js/verification.js" defer></script>
<script type="text/javascript" src="../js/ajax.js" defer></script>

<div id="datacells">
    <div id="settings-div">
    <div id="profile-banner" style="background-image: linear-gradient(rgb(5 25 35 / 0%), rgb(25 25 34)), url(<?=$_SESSION['banner']?>);">
        <div id="pfp-div">
            <img id="settings-pfp" src=<?=$_SESSION['pfp'];?> onerror=this.src="../assets/pfps/default.png" width=130px height=130px>
        </div>
        <div class="overlay">Click to change</div>
    </div>

        <div>
            <p>Your Profile</p>
            <hr>
            <form id="email-psw" class="form-settings" method="POST">
        
                <div>
                    <label class="labels" for="email-settings">Email:</label>
                    <input type="text" name="email" id="email" oninput="emailVal()" placeholder="Email" required>
                    <input type="button" id="change-email" onclick="emailUpdate()" value="Change" required>
                    <br>
                </div>
        
                <div>
                    <label class="labels" for="password-settings">Password:</label>
                    <input type="password" name="password" id="psw" oninput="pswVal()" placeholder="Password">
                    <input type="button" id="change-password" onclick="passwordUpdate()" value="Change" />
                    <br>
                </div>
            </form>

            <form id="pfp-banner" class="form-settings" method="POST" enctype="multipart/form-data" onsubmit="upload(this)">
                <div>
                    <input id ="change-pfp" type="file" name="pfp" value="Change" onchange="$('#submit').click()"/>
                </div>

                <div>
                    <input id="change-banner" type="file" name="banner" value="Change" onchange="$('#submit').click()"/>
                </div>

                <input id="submit" type="submit" name="uploadBtn" value="Upload" />

            </form>

            <div id="results">
                <p id="et" class="tooltip"></p>
                <p id="pt" class="tooltip"></p>
            </div>
        </div>
    </div>
</div>
