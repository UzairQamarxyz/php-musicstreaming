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
                <div class="field-div" id="username-div">
                    <input type="text" name="username" placeholder="Username" id="username" required>
                    <p id="et" class="tooltip"></p>
                </div>
                <div class="field-div" id="psw-div">
                    <input type="password" name="psw" placeholder="Password" id="psw" required>
                    <p id="pt" class="tooltip"></p>
                </div>
                <input type="submit" id="signup" name="login" value="Login" onclick="window.location.href='../php/login.php'"/>
            </form>

            <?php
            session_start();

            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = '';
            $DATABASE_NAME = 'project';
            $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

            if (mysqli_connect_errno()) {
                exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }

            if (isset($_POST["login"])) {
                if ($stmt = $con->prepare('SELECT * FROM users WHERE user_name = ?')) {
                    $stmt->bind_param('s', $_POST['username']);
                    $stmt->execute();
            
                    $result = $stmt->get_result();
                    $num_of_rows = $result->num_rows;

                    echo $_POST['psw'];

                    while ($row = $result->fetch_assoc()) {
                        $user_name = $row["user_name"];
                        $user_email = $row["user_email"];
                        $user_password = $row["user_password"];
                        $user_pfp= $row["user_pfp"];
                        $user_banner = $row["user_banner"];
                    }

            
                    if ($num_of_rows > 0) {
                        if (password_verify($_POST['psw'], $user_password)) {
                            session_regenerate_id();


                            $stmt->free_result();

                            $_SESSION['loggedin'] = true;

                            $_SESSION['name'] = $user_name;
                            $_SESSION['email'] = $user_email;
                            $_SESSION['pfp'] = $user_pfp;
                            $_SESSION['banner'] = $user_banner;

                            $_SESSION['current'] = "streams.php";

                            header('Location: ./template.php');
                        } else {
                            echo <<< EOL
                            <div style="color: white; margin-top: 10px;">Incorrect Password</div>
                        EOL;
                        }
                    } else {
                        echo <<< EOL
                            <div style="color: white; margin-top: 10px;">Incorrect Username</div>
                    EOL;
                    }
            
                    $stmt->close();
                }
            }
            ?>

        </div>
    </main>

</body>

</html>
