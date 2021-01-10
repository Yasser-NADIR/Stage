<?php 
    session_start();
    require_once "Include/function.php";
    verifyAdmin();

    require_once "Include/bd.php";
    $id_concour = $_SESSION["user"]["id_concour"];
    $req = $pdo->prepare("SELECT * FROM t_candidat WHERE id_candidat in( SELECT id_condidat FROM t_liste_candidat_concour WHERE id_concour=:idConcour) ");
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
<style>
    body{
        background: rgba(18, 123, 163, 0.1234);
    }
</style>
<h1 class="my-3" style="text-align: center;">Affichage des candidats inviter au concour</h1>
<table class="table">
        <thead class="table-light">
            <tr>
                <th>Nom et Prenom</th>
                <th>Moyenne</th>
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
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <hr>
<div class="m-3 d-flex justify-content-center">
    <a href="http://localhost/stage/selectListConcour.php" class="btn btn-outline-primary  mx-3">ajouter</a>
    <a href="http://localhost/stage/deleteCondidatCoucour.php" class="btn btn-outline-primary  mx-3">retirer</a>
    <a href="http://localhost/stage/profile.php" class="btn btn-outline-primary  mx-3">retourner au profile</a>
</div>
<?php include_once "Include/Footer.php"?>