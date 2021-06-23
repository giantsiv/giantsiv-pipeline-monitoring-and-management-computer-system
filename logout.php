<?php 
    session_start();
    session_unset();
    unset($_SESSION['loggedin']);
    unset($_SESSION['user_id']);
    session_destroy(); 
    session_write_close();
    header('Location: index.php');
    die();
?>