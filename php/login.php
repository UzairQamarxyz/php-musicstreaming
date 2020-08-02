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
            // Change this to your connection info.
            $DATABASE_HOST = 'localhost';
            $DATABASE_USER = 'root';
            $DATABASE_PASS = '';
            $DATABASE_NAME = 'project';
            // Try and connect using the info above.
            $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
            if (mysqli_connect_errno()) {
                // If there is an error with the connection, stop the script and display the error.
                exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }
            // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
            if ($stmt = $con->prepare('SELECT user_id, user_password FROM users WHERE user_name = ?')) {
            
                // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                $stmt->bind_param('s', $_POST['username']);
                $stmt->execute();
            
                // Store the result so we can check if the account exists in the database.
                $stmt->store_result();
            
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($user_id, $user_password);
                    $stmt->fetch();
                    // Account exists, now we verify the password.
                    // Note: remember to use password_hash in your registration file to store the hashed passwords.
                    if (password_verify($_POST['psw'], $user_password)) {
                        // Verification success! User has loggedin!
                        // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                        session_regenerate_id();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['name'] = $_POST['username'];
                        $_SESSION['id'] = $id;
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
            ?>

        </div>
    </main>

</body>

</html>
