<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="./styles/index.css">
    <link rel="stylesheet" type="text/css" href="./styles/form.css">

    <script type="text/javascript" src="./js/verification.js" defer></script>

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
                <input type="submit" id="signup" name="signup" value="Signup"/>
            </form>
            <?php
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
                
                // We need to check if the account with that username exists.
                if ($stmt = $con->prepare('SELECT user_id, user_password FROM users WHERE user_name = ?')) {
                
                    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
                    $stmt->bind_param('s', $_POST['username']);
                    $stmt->execute();
                    $stmt->store_result();
                
                    // Store the result so we can check if the account exists in the database.
                    if ($stmt->num_rows > 0) {
                
                        // Username already exists
                        echo <<< EOL
                <div style="color: white; margin-top: 10px;">Username unavailable! Please Choose Another</div>;
                EOL;
                    } elseif ($stmt = $con->prepare('SELECT user_id, user_password FROM users WHERE user_email = ?')) {
                        // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
                        $stmt->bind_param('s', $_POST['email']);
                        $stmt->execute();
                        $stmt->store_result();
                
                        // Store the result so we can check if the account exists in the database.
                        if ($stmt->num_rows > 0) {
                
                        // Email already exists
                            echo <<< EOL
                <div style="color: white; margin-top: 10px;">Email already Registered! Please Login</div>;
                EOL;
                        }
                    } else {
                
                        // Username doesnt exists, insert new account
                        // Email doesnt exists, insert new account
                        if ($stmt = $con->prepare('INSERT INTO users (user_name, user_password, user_email) VALUES (?, ?, ?)')) {
                            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
                            $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
                            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                            $stmt->execute();
                            echo <<< EOL
                <div style="color: white; margin-top: 10px;">Successfully Registered! Please Login</div>;
                EOL;
                        } else {
                            // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                            echo 'Could not prepare statement!';
                        }
                    }
                    $stmt->close();
                } else {
                    // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                    echo 'Could not prepare statement!';
                }
                $con->close();
            ?>
        </div>

    </main>

    <script>
    </script>
</body>

</html>
