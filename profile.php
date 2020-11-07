<?php 
    session_start();
    if(!isset($_SESSION["auth"])){
        $_SESSION["flash"]["danger"] = "il te faut s'identifier";
        header("Location: login.php");
        exit();
    }
    require_once "Include/function.php";
    require_once "Include/bd.php";
    $role = $_SESSION["auth"]["role"];
    if($role==1){
        $req = $pdo->prepare("SELECT * FROM t_candidat WHERE id_login=?");    
    }else{
        $req = $pdo->prepare("SELECT * FROM t_responsable WHERE id_login=?");    
    }

    $req->execute([$_SESSION["auth"]["id"]]);
    $user = $req->fetch();
    $_SESSION["user"] = $user;
?>

<?php $title = "profile";
    require_once "Include/Header.php";?>
<?php if($role==1):?>
<?php require_once "Include/profileCondidat.php";?>
<?php else:?>

<?php endif;?>
<?php require_once "Include/Footer.php";?>