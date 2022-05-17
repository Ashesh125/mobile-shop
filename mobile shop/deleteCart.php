<?php
     session_start();
    include 'backend/configuration.php';
     
    $id = $_GET['id'];
    
    // print_r($_SESSION['no_of_items']);
    
    // print_r($_SESSION['product_id']);
    header("location:cart.php");
?>