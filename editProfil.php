<?php 
    session_start();
    require_once "Include/bd.php";
    require_once "Include/function.php";
    if(!empty($_POST)){
        $errors = array();
        if(empty($_POST["nom"]) OR !preg_match("/^[a-zA-Z]+$/", $_POST["nom"])){
            $errors["nom"] = "Nom n'est pas valide";
        }
        if(empty($_POST["prenom"]) OR !preg_match("/^[a-zA-Z]+$/", $_POST["prenom"])){
            $errors["prenom"] = "Prenom n'est pas valide";
        }
        if(empty($_POST["email"]) OR !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            $errors["email"] = "Email n'est pas valide";
        }else{
            $req = $pdo->prepare("SELECT * FROM t_candidat WHERE mail_candidat=? AND id_candidat!=?");
            $req->execute([$_POST["email"], $_SESSION["user"]["id_candidat"]]);
            $user = $req->fetch();
            if($user){
                $errors["email"] = "Email est déjà existe";
            }
        }
        if(empty($_POST["tel"]) OR !preg_match("/^\+212(6|7)[0-9]{8}|0(6|7)[0-9]{8}$/", $_POST["tel"])){
            $errors["tel"] = "Numero de téléphone n'est pas valide";
        }
        if(empty($_POST["cin"])){
            $errors["cin"] = "CIN n'est pas valide";
        }else{
            $req = $pdo->prepare("SELECT * FROM t_candidat WHERE CIN_candidat=? AND id_candidat!=?");
            $req->execute([$_POST["cin"], $_SESSION["user"]["id_candidat"]]);
            $user = $req->fetch();
            if($user){
                $errors["cin"] = "CIN est déjà existe";
            }
        }
        if(empty($_POST["code_massar"]) OR !preg_match("/^[A-Z][0-9]{9}$/",$_POST["code_massar"])){
            $errors["code_massar"] = "Le code massar n'est pas valide";
        }else{
            $req = $pdo->prepare("SELECT * FROM t_candidat WHERE code_massar=? AND id_candidat!=?");
            $req->execute([$_POST["code_massar"], $_SESSION["user"]["id_candidat"]]);
            $user = $req->fetch();
            if($user){
                $errors["code_massar"] = "Code massar est déjà existe";
            }
        }
        if($_POST["etab"]==0){
            $errors["etab"] = "S'il vous plait selectionner une établissement";
        }
        if($_POST["diplome"]==0){
            $errors["diplome"] = "S'il vous plait selectionner un deplôme";
        }
        if(empty($_POST["note1"]) or empty($_POST["note2"]) or empty($_POST["note3"]) or empty($_POST["note4"]) or !is_numeric($_POST["note1"])  or !is_numeric($_POST["note2"]) or !is_numeric($_POST["note3"]) or !is_numeric($_POST["note4"])){
            $errors["note"] = "Les note n'est pas valide";
        }
        if(empty($errors)){
            $req = $pdo->prepare("UPDATE t_candidat SET nom_candidat=?,prenom_candidat=?, mail_candidat=?, CIN_candidat=?, code_massar=?, id_etablissement=?, id_diplomt=?, note_s1=?, note_s2=?, note_s3=?, note_s4=? WHERE id_candidat=?");
            $req->execute([$_POST["nom"],$_POST["prenom"],$_POST["email"],$_POST["cin"],$_POST["code_massar"],$_POST["etab"],$_POST["diplome"],$_POST["note1"],$_POST["note2"],$_POST["note3"],$_POST["note4"],$_SESSION["user"]["id_candidat"]]);
            $_SESSION["flash"]["success"] ="le mise à jour est effectué avec succés";
            header("Location: profile.php");
            exit();
        }
    }
?>

<?php $title = "profile";
require_once "Include/Header.php";?>
<?php if(!empty($errors)):?>
    <ul class="mt-2">
        <?php foreach($errors as $error):?>
            <li class="alert alert-danger"><?=$error;?></li>
        <?php endforeach;?>
    </ul>
<?php endif;?>

<div class="container mt-4">
    <h3 class="mb-5 text-center" ><span style="border-bottom:3px solid black;">Mettre à jour vos données</span></h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Nom</label>
                <input type="text" name="nom" id="" class="form-control" value="<?=$_SESSION['user']['nom_candidat']?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Prenom</label>
                <input type="text" name="prenom" id="" class="form-control" value="<?=$_SESSION['user']['prenom_candidat']?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Email</label>
                <input type="email" name="email" id="" class="form-control" value="<?=$_SESSION['user']['mail_candidat']?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Tel</label>
                <input type="text" name="tel" id="" class="form-control" value="<?=$_SESSION['user']['tel_candidat']?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">CIN</label>
                <input type="text" name="cin" id="" class="form-control" value="<?=$_SESSION['user']['CIN_candidat']?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">Code Massar</label>
                <input type="text" name="code_massar" id="" class="form-control" value="<?=$_SESSION['user']['code_massar']?>">
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
                    <?php endforeach ;?><p>test</p>
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
                <input type="int" name="note1" id="" class="form-control" value="<?=$_SESSION['user']['note_s1']?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">note s2</label>
                <input type="text" name="note2" id="" class="form-control" value="<?=$_SESSION['user']['note_s2']?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">note s3</label>
                <input type="text" name="note3" id="" class="form-control" value="<?=$_SESSION['user']['note_s3']?>">
            </div>
            <div class="form-group col-md-6">
                <label for="">note s4</label>
                <input type="text" name="note4" id="" class="form-control" value="<?=$_SESSION['user']['note_s4']?>">
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-success col-2 mx-3">Envoyer</button>
            <a href="http://localhost/stage/profile.php" class="btn btn-info col-2 mx-1">retourner</a>
        </div>
    </form>
</div>
<?php require_once "Include/Footer.php";?>