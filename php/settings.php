<script type="text/javascript" src="./js/verification.js" defer></script>

<div id="datacells">
    <div id="settings-div">
        <img src="../assets/pfp.png" width="150px" height="150px"/>
        <div>
            <p>Your Profile</p>
            <hr>
            <form id="form-settings" method="POST">
        
                <div>
                    <label for="email-settings">Email:</label>
                    <input type="text" name="email" id="email" oninput="emailVal()" placeholder="Email">
                    <input type="button" id="change-email" onclick="emailUpdate()" value="Change" />
                    <br>
                    
                </div>
        
                <div>
                    <label for="password-settings">Password:</label>
                    <input type="password" name="password" id="psw" oninput="pswVal()" placeholder="Password">
                    <input type="button" id="change-password" onclick="passwordUpdate()" value="Change" />
                    <br>
                </div>

            </form>
            <div id="results">
                    <p id="et" class="tooltip"></p>
                    <p id="pt" class="tooltip"></p>
            </div>
        </div>
    </div>
</div>
<script>
function emailUpdate() {
    var email =  $("#email").val()

    $.post("submit.php", { email: email },

    function(data) {
	 $('#results').html(data);
	 $('#form-settings')[0].reset();
    });
}
function passwordUpdate() {
    var password =  $("#psw").val()

    $.post("submit.php", { password: password },

    function(data) {
	 $('#results').html(data);
	 $('#form-settings')[0].reset();
    });
}
</script>
