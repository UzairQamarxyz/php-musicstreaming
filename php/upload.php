<?php
session_start();
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
    if (isset($_FILES['pfp']) && $_FILES['pfp']['error'] === UPLOAD_ERR_OK) {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['pfp']['tmp_name'];
        $fileName = $_FILES['pfp']['name'];
        $fileSize = $_FILES['pfp']['size'];
        $fileType = $_FILES['pfp']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = $_SESSION['name']. '.' . $fileExtension;
        echo $newFileName;
        $allowedfileExtensions = array('jpg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = '../assets/pfp/';
            $dest_path = $uploadFileDir . $newFileName;
 
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                echo 'File is successfully uploaded.';
            } else {
                echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        }
    }
}
