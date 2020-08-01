<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="../styles/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <main id="main">

        <!-- FORM -->

        <div id="container">
            <form id="form" method="POST">
                <div class="field-div" id="email-div">
                    <input type="text" name="email" placeholder="Email" id="email" oninput="emailVal()" required>
                    <p id="et" class="tooltip"></p>
                </div>
                <div class="field-div" id="psw-div">
                    <input type="password" name="psw" placeholder="Password" id="psw" oninput="pswVal()" required>
                    <p id="pt" class="tooltip"></p>
                </div>
                <input type="submit" id="signup" name="login" value="Login" />
            </form>
        </div>
    </main>

<?php
    $servername ="localhost";
    $pass = '';
    $dbname = "project";
    
    $con = mysqli_connect($servername, $user, $pass, $dbname);
    
    $username = $email = $psw = "";
    
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $psw = $_POST["psw"];
        validateInput($email, $psw, $con);
    }
    
    function validateInput($email, $psw, $con)
    {
        $dbUsername = "
SELECT user_name FROM `users` WHERE user_email='$email' AND user_password='$psw'
";
        $dbEmail = "SELECT * FROM users WHERE user_email='$email' ;";
        $dbPsw= "SELECT * FROM users WHERE user_password='$psw' ;";

        $queryUsername = mysqli_query($con, $dbUsername);
        $queryEmail = mysqli_query($con, $dbEmail);
        $queryPsw = mysqli_query($con, $dbPsw);
    
        if (mysqli_num_rows($queryEmail) == 0) {
            echo <<< EOL
                <div style="color: white; margin-top: 10px;">This Email is not Registered</div>
            EOL;
        } elseif (mysqli_num_rows($queryPsw) == 0) {
            echo <<< EOL
                <div style="color: white; margin-top: 10px;">Wrong Password</div>
            EOL;
        } elseif (mysqli_num_rows($queryUsername) == 0 && mysqli_num_rows($queryEmail) == 0) {
            echo <<< EOL
                <div style="color: white; margin-top: 10px;">Signup Successful</div>
            EOL;
        }
    }
?>

    <script>
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
    </script>

</body>

</html>
