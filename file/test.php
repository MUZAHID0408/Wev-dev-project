<?php

    $host = "localhost";
    $dataBase_userName = "root";
    $dataBase_password = "";
    $dataBase_name = "log_info";
    
    $conn = mysqli_connect($host, $dataBase_userName, $dataBase_password, $dataBase_name);

    if(mysqli_connect_error()){
        die("There was an error while connecting to the database.");
    }


    $query = "SELECT * FROM users";

    if($result = mysqli_query($conn, $query)){
        $data_info = mysqli_fetch_array($result);
    }

    print_r ($data_info);
?>


