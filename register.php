<?php 
    require "Include/function.php";
    require "Include/bd.php";
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
        }
        if(empty($_POST["tel"]) or !preg_match("/^\+212[0-9]{9}|0[6-7][0-9]{8}$/", $_POST["tel"])){
            $errors["tel"] = "téléphone n'est pas valide";
        }
        if(empty($_POST["cin"])){
            $errors["cin"] = "cin n'est pas valide";
        }
        if(empty($_POST["code_massar"]) or !preg_match("/^[A-Z][0-9]{9}$/", $_POST["code_massar"])){
            $errors["code_massar"] = "code massar n'est pas valide";
        }
        if($_POST["etab"] == "0"){
            $errors["etab"] = "Choisi une établissement";
        }
        if($_POST["diplome"] == "0"){
            $errors["diplome"] = "Choisi une diplome";
        }
        if(!is_numeric($_POST["note1"])  or !is_numeric($_POST["note2"]) or !is_numeric($_POST["note3"]) or !is_numeric($_POST["note4"])){//
            $errors["S"] = "les notes ne sont pas valide";
        }
        if(empty($_FILES["releve"]["name"])){
            $errors["releve"] = "choisi votre relevé de note";
        }else{
            $name = $_FILES["releve"]["name"];
            $filePath = upload("releve");
        }

        if(empty($_POST["pseudo"]) or !preg_match("/^[a-zA-Z0-9_]+$/", $_POST["pseudo"])){
            $errors["pseudo"] = "pseudo n'est pas valide";
        }
        if(empty($_POST["password"]) or $_POST["password"] != $_POST["confirm_password"]){
            $errors["mot de passe"] = "mot de passe n'est pas valide";
        }
        if(empty($errors)){
            $file = fopen($filePath, "r");
            $content = fread($file, filesize($filePath));
            fclose($file);
            $req = $pdo->prepare("INSERT INTO t_biblio_binaire SET biblio_contenu=?, biblio_nom=?");
            $req->execute([$file, $name]);
            //$req = $pdo->prepare("INSERT INTO t_candidat SET nom_candidat=?, prenom_candidat=?, mail_candidat=?, tel_candidat=?,CIN_candidat=?,code_massar=?,id_etablissement=?,id_diplomt=?,note_s1=?,note_s2=?,note_s3=?,note_s4=?");
        }
    }
?>
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
    <form action="" method="post" enctype="multipart/form-data">
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
                    <option value="1">FSTM</option>
                    <option value="2">FSBinMsik</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">diplime</label>
                <select name="diplome" id="exampleSelect1" class="form-control">
                    <option value="0">Selectionner un diplome</option>
                    <option value="1">DEUG</option>
                    <option value="2">DEUST</option>
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
            <label for="">Relevé de note</label>
            <input type="file" name="releve" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
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
        <button type="submit" class="btn btn-success">S'inscrire</button>
    </form>
</div>
<?php require "Include/Footer.php";?>
