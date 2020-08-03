<?php
    session_start();

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'project';
    
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
        echo "error";
    
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    
    if (isset($_POST['email'])){
        if ($stmt = $con->prepare('UPDATE users SET user_email = ? WHERE user_name= ?')) {
        
            $stmt->bind_param('ss', $_POST['email'], $_SESSION['name']);
            $stmt->execute();
            echo <<< EOL
                    <div style="color: #00a6fb;">Email Updated!</div>
                EOL;
        } else {
            echo 'Could not prepare statement!';
        }
    }
    if (isset($_POST['password'])){
        if ($stmt = $con->prepare('UPDATE users SET user_password= ? WHERE user_name= ?')) {
            $hashed_password = password_hash($_POST['psw'], PASSWORD_DEFAULT); 
            $stmt->bind_param('ss', $hashed_password, $_SESSION['name']);
            $stmt->execute();
            echo <<< EOL
                    <div style="color: #00a6fb;">Password Updated!</div>
                EOL;
        } else {
            echo 'Could not prepare statement!';
        }
    }
    $con->close();
?>
