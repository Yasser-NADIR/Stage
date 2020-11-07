<?php 
    session_start();
    if(isset($_SESSION["auth"])){
        header("Location: profile.php");
        die();
    }
?>

<?php 
    $title = "Home";
    require "Include/Header.php";
?>

<?php require "Include/Footer.php"?>