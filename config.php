<?php
    $host    = "localhost";
    $user    = "root";
    $pass    = "";
    $dbname = "sayur";
    
    $conn = mysqli_connect($host, $user, $pass) or die('Could not connect to mysql server.' );
    
    mysqli_select_db($conn, $dbname) or die('Could not select database.');
    
    $baseurl="http://localhost/sayur/";
?>