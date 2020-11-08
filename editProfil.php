<?php 
    
?>

<?php $title = "profile";
require_once "Include/Header.php";?>

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
        <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
</div>
<?php require_once "Include/Footer.php";?>