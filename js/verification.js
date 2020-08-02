function login() {
    window.open('./php/login.php', '_blank')
}

// EMAIL VALIDATION
function emailVal() {
    var emailRegex = /^\w+([\.-]?\w+)*@\w+(\.\w{2,3})/
    var email = document.getElementById("email").value

    if (!email.match(emailRegex) || email.length == 0) {
        $("#et").text("*Please Enter a Valid Email").css({
            "color": "crimson",
            "font-weight": "bold"
        })
        return false
    } else {
        $("#et").text("*The entered email is valid").css({
            "color": "#00a6fb",
            "font-weight": "bold"
        })
        return true
    }
}

// USERNAME VALIDATION
function userVal() {
    var userRegex = /^[a-zA-Z]+[^\W_]{3,}/
    var username = document.getElementById("username").value

    if (!username.match(userRegex) || username.length == 0) {
        $("#ut").text("*Username must be alphanumeric with no special characters and must be atleast 4 letters long").css({
            "color": "crimson",
            "font-weight": "bold"
        })
        return false
    } else {
        $("#ut").text("*The username is valid").css({
            "color": "#00a6fb",
            "font-weight": "bold"
        })
        return true
    }
}

// PASSWORD VALIDATION
function pswVal() {
    var strongPsw = /^(?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z])(?=\D*\d)(?=.*[!@#$%^&-+=()<>,./?;:'"\\|\[\]{}])(?=.{8,})/
    var medPsw = /^(((?=[^a-z]*[a-z])(?=[^A-Z]*[A-Z]))|((?=[^a-z]*[a-z])(?=\D*\d))|((?=[^a-z]*[a-z])(?=.*[!@#$%^&-+=()<>,./?;:'"\\|\[\]{}])))(?=.{6,})/
    var psw = document.getElementById("psw").value

    if (psw.match(strongPsw)) {
        $("#pt").text("*Password Strength: Strong").css({
            "color": "#00a6fb",
            "font-weight": "bold"
        })
        return true
    } else if (psw.match(medPsw)) {
        $("#pt").text("*Password Strength: Medium").css({
            "color": "gold",
            "font-weight": "bold"
        })
        return true
    } else if (psw.length < 6) {
        $("#pt").text("*Password must be atleast 6 characters").css({
            "color": "crimson",
            "font-weight": "bold"
        })
        return false
    } else {
        $("#pt").text("*Password Strength: Weak").css({
            "color": "crimson",
            "font-weight": "bold"
        })
        return true
    }
}
