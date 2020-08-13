<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="./styles/index.css">
    <link rel="stylesheet" type="text/css" href="./styles/form.css">

    <link rel="stylesheet" media='screen and (min-width: 140px) and (max-width: 360px) and (-webkit-min-device-pixel-ratio: 1)' href="./styles/universal/phone.css"/>
    <link rel="stylesheet" media='screen and (min-width: 361px) and (max-width: 1024px) and (-webkit-min-device-pixel-ratio: 1)' href="./styles/universal/tablet.css"/>

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
                <button id="login-hidden" onclick="login()">Login</button>
            <?php
                include "./php/dbcon.php";

                $con = OpenCon();
                
                if (isset($_POST['signup'])) {
                    if ($stmt = $con->prepare('SELECT user_id, user_password FROM users WHERE user_name = ?')) {
                        $stmt->bind_param('s', $_POST['username']);
                        $stmt->execute();
                        $stmt->store_result();

                        if (!$stmt->num_rows > 0) {
                            $con = OpenCon();
                            if ($stmt = $con->prepare('SELECT user_id, user_password FROM users WHERE user_email = ?')) {
                                $stmt->bind_param('s', $_POST['email']);
                                $stmt->execute();
                                $stmt->store_result();
                
                                if (!$stmt->num_rows > 0) {
                                    $con = OpenCon();
                                    if ($stmt = $con->prepare('INSERT INTO users (user_name, user_password, user_email) VALUES (?, ?, ?)')) {
                                        $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
                                        $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
                                        $stmt->execute();

                                        echo <<< EOL
                                            <div style="color: white; margin-top: 10px;">Successfully Registered! Please Login</div>;
                                            EOL;
                                    } else {
                                        echo 'Could not prepare statement!';
                                    }
                                } else {
                                    echo <<< EOL
                                        <div style="color: white; margin-top: 10px;">Email already Registered! Please Login</div>;
                                        EOL;
                                }
                            }
                        } else {
                            echo <<< EOL
                                <div style="color: white; margin-top: 10px;">Username unavailable! Please Choose Another</div>;
                                EOL;
                        }
                    }
                }
                CloseCon($con);
            ?>
        </div>

    </main>
</body>

</html>
