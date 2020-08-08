<?php
function OpenCon()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'project';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME) or die("Connect failed: %s\n". $conn -> error);
    return $con;
}
 
function CloseCon($conn)
{
    $conn -> close();
}
