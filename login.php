<?php 
    session_start();
    require_once "Include/bd.php";
    if(isset($_SESSION["auth"])){
        header("Location: profile.php");
        die();
    }
    if(!empty($_POST)){
        $errors = array();
        if(empty($_POST["pseudo"]) OR !preg_match("/^[a-zA-Z0-9]+$/", $_POST["pseudo"])){
            $errors["pseudo"] = "pseudo n'est pas valide";
        }

        if(empty($_POST["password"])){
            $errors["password"] = "entre un mot de passe";
        }

        if(empty($errors)){
            $req = $pdo->prepare("SELECT * FROM t_login WHERE pseudo = ?");
            $req->execute([$_POST["pseudo"]]);
            $user = $req->fetch();
            if($user AND password_verify($_POST["password"], $user["password"])){
                $_SESSION["flash"]["success"] = "Bievenu dans votre profil";
                header("Location: profile.php");
                $_SESSION["auth"] = $user;
                exit();
            }
            $_SESSION["flash"]["danger"] = "pseudo ou le mot de passe est incorrect";
        }
    }
?>
<style>
    .box-form{
        border: 1px solid black;
        width: 30vw;
        padding: 40px;
        background: rgba(18, 123, 163, 0.1234);
        border-radius: 5px;
        margin: 7vw auto !important;
        box-shadow: 5px 5px 5px black;
        min-width: 350px;
    }
    form h1{
        border-bottom: 2px dotted black;
        width: min-content;
        margin: auto;
        padding-bottom: 5px;
    }
    .form-group input{
        box-shadow: 1px 1px 2px black;
    }
    label{
        font-size: 1.3em;
    }
    .form-group{
        margin: 20px auto;
    }
</style>
<?php $title = "Se connecter";
    require_once "Include/Header.php";?>
<?php if(!empty($errors)):?>
    <ul class="mt-2">
        <?php foreach($errors as $error):?>
            <li class="alert alert-danger"><?=$error;?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>
<div class="Xmx-auto Xmt-4 box-form">
    <form action="" method="post">
        <div class="d-flex justify-content-center flex-column m-2">
            <h1 class="text-center"><img src="Static/img/login2.png" alt=""> login:</h1>
            <div class="form-group">
                <div class="mx-auto">
                    <label for="">Peusdo:</label>
                    <input type="text" name="pseudo" id="" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="mx-auto">
                    <label for="">Mot de passe:</label>
                    <input type="password" name="password" id="" class="form-control">
                </div>
            </div>
            <div class="mx-auto">
                <button type="submit" class="btn btn-primary">S'identifier</button>
            </div>
        </div>
    </form>
</div>
<?php require_once "Include/Footer.php";?>