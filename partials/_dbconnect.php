<?php
    // connecting to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "idiscuss";

    // create a connection 
    $conn = mysqli_connect($servername, $username, $password, $database);

    // // Die if connection was not successful
    // if(!$conn){
    //     die("sorry we failed to connnect".mysqli_connect_error());
    // }
    // else{
    // echo "connection was successful";
    // }
?>