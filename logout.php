<?php 
    session_start();

    $_SESSION = [];
    session_destroy();
    setcookie("login", "", time() - 3600);

    header("location: index.php");
?>