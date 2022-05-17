<?php
    
    include 'index_body/header.php';
    include 'backend/configuration.php';
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    $_SESSION['no_of_items'][$id] = $qty;
   

printf($_SESSION['no_of_items']);
?>