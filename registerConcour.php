<?php
    session_start();
    require_once "Include/bd.php";
    if(isset($_SESSION) and isset($_SESSION["user"])){
        $id_concour = $_GET["id"];
        $id_condidat = $_SESSION["user"]["id_candidat"];
        $req = $pdo->prepare("SELECT * FROM t_concours WHERE id_concours=?");
        $req->execute([$id_concour]);
        $concour = $req->fetch();
        $req = $pdo->prepare("SELECT * FROM t_liste_concour WHERE id_concour=? AND id_condidat=?");
        $req->execute([$id_concour, $id_condidat]);
        $liste_concour = $req->fetch();
        if($concour){
            if(!$liste_concour){
                $req = $pdo->prepare("INSERT INTO t_liste_concour SET id_concour=?, id_condidat=?");
                $req->execute([$id_concour, $id_condidat]);
            }
        }else{
            $_SESSION["flash"]["danger"] = "lien n'est pas valide";
        }
        header("Location: profile.php");
    }else{
        $_SESSION["flash"]["danger"] = "il te faut se connecter";
        header("Location: login.php");
    }
    
    exit();

    
