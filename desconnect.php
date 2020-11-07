<?php 
    session_start();
    unset($_SESSION["auth"]);
    $_SESSION["flash"]["success"] = "vous êtes deconnecté";
    header("Location: login.php");