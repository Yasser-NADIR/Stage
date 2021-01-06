<?php 
    session_start();
    require "Include/function.php";
    if(isset($_SESSION["auth"])){
        header("Location: profile.php");
        die();
    }
    if(!empty($_POST) ){
        $errors = array();
        if(empty($_POST["nom"]) or !preg_match("/^[a-zA-Z]+$/", $_POST["nom"])){
            $errors["nom"] = "nom non valide";
        }
        if(empty($_POST["prenom"]) or !preg_match("/^[a-zA-Z]+$/", $_POST["prenom"])){
            $errors["prenom"] = "prenom non valide";
        }
        if(empty($_POST["email"]) or !filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)){
            $errors["email"] = "email n'est pas valide";
        }else{
            $req = $pdo->prepare("SELECT * FROM t_candidat WHERE mail_candidat=?");
            $req->execute([$_POST["email"]]);
            $user = $req->fetch();
            if($user){
                $errors["email"] = "cet email est déjà utililsé";
            }
        }
        if(empty($_POST["tel"]) or !preg_match("/^\+212(6|7)[0-9]{8}|0(6|7)[0-9]{8}$/", $_POST["tel"])){
            $errors["tel"] = "téléphone n'est pas valide";
        }
        if(empty($_POST["cin"])){
            $errors["cin"] = "cin n'est pas valide";
        }else{
            $req = $pdo->prepare("SELECT * FROM t_candidat WHERE CIN_candidat =?");
            $req->execute([$_POST["cin"]]);
            $user = $req->fetch();
            if($user){
                $errors["cin"] = "ce cin est déjà utililsé";
            }
        }

        if(empty($_POST["code_massar"]) or !preg_match("/^[A-Z][0-9]{9}$/", $_POST["code_massar"])){
            $errors["code_massar"] = "code massar n'est pas valide";
        }else{
            $req = $pdo->prepare("SELECT * FROM t_candidat WHERE code_massar =?");
            $req->execute([$_POST["code_massar"]]);
            $user = $req->fetch();
            if($user){
                $errors["code_massar"] = "ce code massar est déjà utililsé";
            }
        }

        if($_POST["etab"] == "0"){
            $errors["etab"] = "Choisi une établissement";
        }
        if($_POST["diplome"] == "0"){
            $errors["diplome"] = "Choisi une diplome";
        }
        if(empty($_POST["note1"]) or empty($_POST["note2"]) or empty($_POST["note3"]) or empty($_POST["note4"]) or !is_numeric($_POST["note1"])  or !is_numeric($_POST["note2"]) or !is_numeric($_POST["note3"]) or !is_numeric($_POST["note4"])){//
            $errors["S"] = "les notes ne sont pas valide";
        }
        if(empty($_FILES["releve"]["name"])){
            $errors["releve"] = "choisi votre relevé de note";
        }else{
            $filePath = upload("releve");
        }

        if(empty($_POST["pseudo"]) or !preg_match("/^[a-zA-Z0-9_]+$/", $_POST["pseudo"])){
            $errors["pseudo"] = "pseudo n'est pas valide";
        }else{
            $req = $pdo->prepare("SELECT * FROM t_login WHERE pseudo=?");
            $req->execute([$_POST["pseudo"]]);
            $user = $req->fetch();
            if($user){
                $errors["pseudo"] = "ce pseudo n'est pas disponible";
            }
        }

        if(empty($_POST["password"]) or $_POST["password"] != $_POST["confirm_password"]){
            $errors["mot de passe"] = "mot de passe n'est pas valide";
        }
        if(empty($errors)){
            $name = explode(".", $_FILES["releve"]["name"]);//split by "."
            $file = fopen($filePath, "r");
            $content = fread($file, filesize($filePath));
            fclose($file);
            //sauvgarde fichier dans la base de donnée
            $req = $pdo->prepare("INSERT INTO t_biblio_binaire SET biblio_contenu=?, biblio_nom=?, biblio_extention=?");
            $req->execute([$file, $name[0], $name[1]]);
            $id_biblio = $pdo->lastInsertId();
            //sauvgarde login 
            $req = $pdo->prepare("INSERT INTO t_login SET pseudo=?, password=?, role=?, confirmation_token=?");
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $token = strRandom(60);
            $req->execute([$_POST["pseudo"], $password, 1, $token]);//role 1: etudiant/ 2:prof
            $id_login = $pdo->lastInsertId();
            //sauvgarde condidat
            $req = $pdo->prepare("INSERT INTO t_candidat SET nom_candidat=?, prenom_candidat=?, mail_candidat=?, 
                                tel_candidat=?,CIN_candidat=?,code_massar=?,id_etablissement=?,id_diplomt=?,
                                note_s1=?,note_s2=?,note_s3=?,note_s4=?, releve_note=?, id_login=?");
            $req->execute([$_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["tel"], $_POST["cin"],
             $_POST["code_massar"], $_POST["etab"],$_POST["diplome"], $_POST["note1"], $_POST["note2"], 
             $_POST["note3"], $_POST["note4"], $id_biblio, $id_login]);
            //envoye d'email de confirmation
            $url = "http://localhost/Stage/confirm.php?id=$id_login&token=$token";
            send($_POST["email"], "Confirmation d'inscription", "Pour confirmer votre inscription, cliquer sur ce lien ".$url);
            //message d'inscription
            $_SESSION["flash"]["primary"] = "Un email de confirmation est envoyé";
            header("Location: login.php");
            exit();
        }
    }
?>
<style>
    .box-form{
        border: 1px solid black;
        padding: 40px;
        background: rgba(18, 123, 163, 0.1234);
        border-radius: 5px;
        box-shadow: 5px 5px 5px black;
        min-width: 360px;
    }
    form h1{
        border-bottom: 2px dotted black;
        width: min-content;
        margin: auto;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }
    label{
        font-size: 1.3em;
    }
    .form-group input{
        box-shadow: 1px 1px 2px black;
    }
</style>
<?php 
    $title = "S'inscrire";
    require "Include/Header.php";
?>

<?php if(!empty($errors)):?>
    <ul class="mt-2">
        <?php foreach($errors as $error):?>
            <li class="alert alert-danger"><?=$error;?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>

<div class="container py-lg-5"> 
    <div class="box-form">
    
    <form action="" method="post" enctype="multipart/form-data" >
    <h1 class="text-center"><img src="Static/img/signup.png" alt=""> login:</h1>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Nom</label>
                <input type="text" name="nom" id="" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">Prenom</label>
                <input type="text" name="prenom" id="" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Email</label>
                <input type="email" name="email" id="" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">Tel</label>
                <input type="text" name="tel" id="" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">CIN</label>
                <input type="text" name="cin" id="" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">Code Massar</label>
                <input type="text" name="code_massar" id="" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Etablissement</label>
                <select name="etab" id="exampleSelect1" class="form-control">
                <option value="0">Selectionner une etablisement</option>
                    <?php
                        $itabs = getItab();
                        foreach($itabs as $itab):
                    ?>
                    <option value="<?= $itab[0]?>"><?= $itab[1]?></option>
                    <?php endforeach ;?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">diplôme</label>
                <select name="diplome" id="exampleSelect1" class="form-control">
                    <option value="0">Selectionner un diplome</option>
                    <?php
                        $itabs = getDiplomt();
                        foreach($itabs as $itab):
                    ?>
                    <option value="<?= $itab[0]?>"><?= $itab[1]?></option>
                    <?php endforeach ;?>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">note s1</label>
                <input type="int" name="note1" id="" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">note s2</label>
                <input type="text" name="note2" id="" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">note s3</label>
                <input type="text" name="note3" id="" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">note s4</label>
                <input type="text" name="note4" id="" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="">Relevé de note <sub>(Sous forme d'une image)</sub></label>
            <input type="file" name="releve" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" accept="image/*">
        </div>
        <hr class="my-4">
        <h2>Pour se connecter</h2>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Pseudo</label>
                <input type="int" name="pseudo" id="" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="">Mot de passe</label>
                <input type="password" name="password" id="" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="">Confirmation de mot de passe</label>
                <input type="password" name="confirm_password" id="" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary">S'inscrire</button>
        <a href="login.php" class="btn btn-outline-primary">Se connecter</a>
    </form>
    </div>
</div>
<?php require "Include/Footer.php";?>
