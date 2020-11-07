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
<?php $title = "Se connecter";
    require_once "Include/Header.php";?>
<?php if(!empty($errors)):?>
    <ul class="mt-2">
        <?php foreach($errors as $error):?>
            <li class="alert alert-danger"><?=$error;?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>
<div class="container mt-4">
    <form action="" method="post">
        <div class="d-flex justify-content-center flex-column">
            <h1 class="text-center">login:</h1>
            <div class="form-group row-cols-2">
                <div class="mx-auto">
                    <label for="">Peusdo:</label>
                    <input type="text" name="pseudo" id="" class="form-control">
                </div>
            </div>
            <div class="form-group row-cols-2">
                <div class="mx-auto">
                    <label for="">Mot de passe:</label>
                    <input type="password" name="password" id="" class="form-control">
                </div>
            </div>
            <div class="mx-auto">
                <button type="submit" class="btn btn-success">S'identifier</button>
            </div>
        </div>
    </form>
</div>
<?php require_once "Include/Footer.php";?>