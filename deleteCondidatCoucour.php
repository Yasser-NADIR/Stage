<?php 
    session_start();
    if(!isset($_SESSION["auth"])){
        $_SESSION["flash"]["danger"] = "il te faut s'identifier";
        header("Location: login.php");
        exit();
    }
    if($_SESSION["auth"]["role"]!=2){
        $_SESSION["flash"]["danger"] = "tu as pas le droit d'entrer icic";
        header("Location: profile.php");
        exit();
    }

    require_once "Include/bd.php";
    require_once "Include/function.php";
    $id_concour = $_SESSION["user"]["id_concour"];
    if(!empty($_POST)){//il faut supprimer les condidat selectionner et pas les ajouter une deuxiemme fois
        $query = "DELETE FROM t_liste_candidat_concour WHERE id_condidat in (";
        $liste_condidat_concour = array();
        foreach($_POST as $id_candidat=>$on){
            $query = $query."?,";
            array_push($liste_condidat_concour, $id_candidat);
        }
        $query = substr($query, 0, strlen($query)-1);//pour supprimer le dernier "," ajouter
        $query = $query.")";
        $req = $pdo->prepare($query);
        $req->execute($liste_condidat_concour);
        
    }

    
    $req = $pdo->prepare("SELECT * FROM t_candidat WHERE id_candidat in ( SELECT id_condidat FROM t_liste_candidat_concour WHERE id_concour=:idConcour) ");
    $req->execute(["idConcour"=>$id_concour]);
    $liste = $req->fetchall();
    for($i=0; $i<count($liste); $i++){
        $liste[$i]["m"] = ($liste[$i]["note_s1"]+$liste[$i]["note_s2"]+$liste[$i]["note_s3"]+$liste[$i]["note_s4"])/4;
    }
    usort($liste, "triParMoyen");
?>
<?php
    $title = "liste concour";
    require_once "Include/Header.php";
?>
<h1 class="my-3" style="text-align: center;">Selectionner des candidats pour retirer de ce concour</h1>
<?php if(empty($liste)):?>
    <div class="alert alert-warning"><h2 class="m-0" style="text-align: center;">Il n'y a plus du candidat à selectionner</h2></div>
<?php endif;?>
<form action="" method="post">
    <table class="table">
        <thead class="table-light">
            <tr>
                <th>Nom et Prenom</th>
                <th>Moyenne</th>
                <th>Selectionner</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($liste as $item):?>
            <tr>
                <td>
                    <?=$item["nom_candidat"]." ".$item["prenom_candidat"]?>
                </td>
                <td>
                    <?= ($item["note_s1"]+$item["note_s2"]+$item["note_s3"]+$item["note_s4"])/4;?>
                </td>
                <td>
                    <input type="checkbox" name="<?=$item["id_candidat"]?>" id="1" class="form-check">
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <button type="submit" class="btn btn-success mt-3">Retirer</button>
</form>
<hr>
<div class="my-3">
    <a href="http://localhost/stage/selectListConcour.php" class="btn btn-primary">ajouter</a>
    <a href="http://localhost/stage/finalList.php" class="btn btn-primary">la liste finale</a>
    <a href="http://localhost/stage/profile.php" class="btn btn-primary">retourner au profile</a>
</div>
<?php include_once "Include/Footer.php"?>