<?php 
    session_start();
    if(isset($_SESSION["auth"])){
        header("Location: profile.php");
        die();
    }
?>
<style>
    img{
        width: 100%;
    }
    a{
        font-size: 1.3em !important;
    }
</style>
<?php 
    $title = "Home";
    require "Include/Header.php";
?>

    <img src="Static/img/homeFontImage.jpg">
    <h1 class="text-center">Bienvenue dans la platforme de l'inscription dans les concour d'ENSET</h1>
    <div class="d-flex justify-content-center">
        <a href="register.php" class="btn btn-outline-primary mx-4">S'inscrire</a>
        <div style="border: 1px solid black;transform: rotate(45deg);"></div>
        <a href="login.php" class="btn btn-primary mx-4">Se connecter</a>
    </div>
</div>
<?php require "Include/Footer.php"?>