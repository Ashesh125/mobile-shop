<?php
    $host="localhost";
    $username="root";
    $password="";
    $database="mobileshop";

    $conn = mysqli_connect($host,$username,$password,$database);
    if($conn -> error){
        echo"error";
    }
?>