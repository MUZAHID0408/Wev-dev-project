<?php
    $conn = mysqli_connect("localhost", "root", "", "log_info");

    if(!$conn){
        die("Database connection error". mysqli_connect_error());
    }
    
?>