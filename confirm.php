<?php 
    session_start();
    require_once "Include/bd.php";
    $id = $_GET["id"];
    $token = $_GET["token"];
    $req = $pdo->prepare("SELECT * FROM t_login WHERE id=?");
    $req->execute([$id]);
    $user = $req->fetch();
    if($user AND $token == $user["confirmation_token"]){
        $pdo->prepare("UPDATE t_login SET cconfirmation_token=NULL, confirmed_at=NOW()");
        $_SESSION["flash"]["danger"] = "vous avez confirmé votre compte";
        header("Location: login.php");
    }else{
        $_SESSION["flash"]["danger"] = "La confirmation n'est pas valide";
        header("Location: regiter.php");
    }