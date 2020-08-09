<?php
session_start();
include "dbcon.php";

    if (isset($_FILES['pfp']) && $_FILES['pfp']['error'] === UPLOAD_ERR_OK) {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['pfp']['tmp_name'];
        $fileName = $_FILES['pfp']['name'];
        $fileSize = $_FILES['pfp']['size'];
        $fileType = $_FILES['pfp']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = $_SESSION['name']. '.png';
        $allowedfileExtensions = array('jpg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = '../assets/uploads/pfps/';
            $dest_path = $uploadFileDir . $newFileName;

            $con = OpenCon();

            if ($stmt = $con->prepare('UPDATE users SET user_pfp= ? WHERE user_name= ?')) {
                $stmt->bind_param('ss', $dest_path, $_SESSION['name']);
                $stmt->execute();

                $_SESSION['pfp'] = $dest_path;

                echo <<< EOL
                    <div id="pfp-uploaded" style="color: #00a6fb;">Profile Picture Updated!</div>
                EOL;
            } else {
                echo 'Could not prepare statement!';
            }
 
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                echo 'File is successfully uploaded.';
            } else {
                echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        }
    }

    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['banner']['tmp_name'];
        $fileName = $_FILES['banner']['name'];
        $fileSize = $_FILES['banner']['size'];
        $fileType = $_FILES['banner']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = $_SESSION['name']. '.png';
        $allowedfileExtensions = array('jpg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = '../assets/uploads/banners/';
            $dest_path = $uploadFileDir . $newFileName;
            
            $con = OpenCon();

            if ($stmt = $con->prepare('UPDATE users SET user_banner= ? WHERE user_name= ?')) {
                $stmt->bind_param('ss', $dest_path, $_SESSION['name']);
                $stmt->execute();

                $_SESSION['banner'] = $dest_path;

                echo <<< EOL
                    <div id="banner-uploaded" style="color: #00a6fb;">Banner Updated!</div>
                EOL;
            } else {
                echo 'Could not prepare statement!';
            }
 
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                echo 'File is successfully uploaded.';
            } else {
                echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        }
    }
?>
