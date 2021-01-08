<?php 
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Static/bootstrap.min.css">
    <title><?=$title?></title>
    <style>
        .logo{
            border-left: 5px solid white;
            border-radius: 2px;
            padding-left: 10px;
            font-size: 2em;
        }
        .desconnection{
            border: 1px solid white;
            border-radius: 5px;
            font-size: 1.3em;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-1">
    <a href="index.php" class="navbar-brand mt-1"><h2 class="logo">ENSET</h2></a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
        <?php if(isset($_SESSION["auth"])): ?>
            <li class="nav-item">
                <a href="desconnect.php" class="nav-link active desconnection">Se deconnecter</a>
            </li>
        <?php endif; ?>
        </ul>
    </div>
</nav>
<?php if(isset($_SESSION["flash"])):?>
    <div class="container">
    <?php foreach($_SESSION["flash"] as $type => $message):?>
        <div class="alert alert-<?=$type;?> mt-2"><?=$message;?></div>
    <?php endforeach;?>
    </div>
    <?php unset($_SESSION["flash"]) ?>
<?php endif; ?>
<div class="container mb-5">
