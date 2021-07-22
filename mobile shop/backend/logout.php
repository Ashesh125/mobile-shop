<?php
     session_start();
     session_unset();
     session_destroy(); 
     //echo "<script>alert('Session has Expired!')</script>";
     header('Location:http://localhost/mobile%20shop/index.php');
?>