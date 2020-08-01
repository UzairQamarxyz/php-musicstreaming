<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
    <link rel="stylesheet" type="text/css" href="./styles/form.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <main id="main">
        <div id="content">
            <header id="header">SITE NAME</header>
            <p id="desc">Site Description</p>
            <button id="login" onclick="login()">Login</button>
        </div>

        <!-- FORM -->

        <div id="container">
            <form id="form" method="POST" action="">
                <div class="field-div" id="email-div">
                    <input type="text" name="email" placeholder="Email" id="email" oninput="emailVal()" required>
                    <p id="et" class="tooltip"></p>
                </div>
                <div class="field-div" id="user-div">
                    <input type="text" name="username" placeholder="Username" id="username" oninput="userVal()" required>
                    <p id="ut" class="tooltip"></p>
                </div>
                <div class="field-div" id="psw-div">
                    <input type="password" name="psw" placeholder="Password" id="psw" oninput="pswVal()" required>
                    <p id="pt" class="tooltip"></p>
                </div>
                <input type="submit" id="signup" name="signup" value="Signup" />
            </form>
<?php
    $servername ="localhost";
    $user ="root";
    $pass = '';
    $dbname = "project";
    
    $con = mysqli_connect($servername, $user, $pass, $dbname);
    
    $username = $email = $psw = "";
    
    if (isset($_POST["signup"])) {
       $username = $_POST["username"];
       $email = $_POST["email"];
       $psw = $_POST["psw"];
       validateInput($username, $email, $con);
    }
    
    function validateInput($username, $email, $con)
    {
        $dbUsername = "SELECT * FROM users WHERE user_name='$username' ;";
        $dbEmail = "SELECT * FROM users WHERE user_email='$email' ;";

        $queryUsername = mysqli_query($con, $dbUsername);
        $queryEmail= mysqli_query($con, $dbEmail);
    
        if (mysqli_num_rows($queryEmail) > 0) {
            echo <<< EOL
                <div style="color: white; margin-top: 10px;">This Email is Already in use</div>
            EOL;
        }
        else if (mysqli_num_rows($queryUsername) > 0) {
            echo <<< EOL
                <div style="color: white; margin-top: 10px;">This Username is Already Taken</div>
            EOL;
        }
        else if (mysqli_num_rows($queryUsername) == 0 && mysqli_num_rows($queryEmail) == 0) {
            echo <<< EOL
                <div style="color: white; margin-top: 10px;">Signup Successful</div>
            EOL;

            insertuser($con);
        }
    }
    
    function insertuser($con)
    {
        $insertQuery = "INSERT INTO users (user_id, user_name, user_email, user_password)
        VALUES(DEFAULT, '$GLOBALS[username]', '$GLOBALS[email]', '$GLOBALS[psw]');";
    
        mysqli_query($con, $insertQuery);
    }
?>

        </div>
    </main>
    <script>
        function login() {
            window.open('./http/login.html', '_blank')
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
    </script>
</body>

</html>
