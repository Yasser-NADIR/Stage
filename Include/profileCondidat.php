<?php 
    $concours = $pdo->query("SELECT * FROM t_concours")->fetchall();
    $req = $pdo->prepare("SELECT id_concour FROM t_liste_concour WHERE id_condidat=?");
    $req->execute([$_SESSION["user"]["id_candidat"]]);
    $liste_concour = $req->fetchall();
    //les noms des concours que le candidat s'enregistre
    $req = $pdo->prepare("SELECT * FROM t_concours WHERE id_concours in (SELECT id_concour from t_liste_concour WHERE id_condidat=:idCondidat) AND id_concours not in (SELECT id_concour from t_liste_candidat_concour) AND id_concours not in (SELECT id_concour from t_liste_candidat_concour WHERE id_condidat=:idCondidat)");
    $req->execute(["idCondidat"=>$_SESSION["user"]["id_candidat"]]);
    $liste_concour_enregistre = $req->fetchall();
    //liste des condidats qui sont invité dans tous les concours sauf le condidat en question
    $req = $pdo->prepare("SELECT titre_concour from t_concours WHERE id_concours in (SELECT id_concour FROM t_liste_candidat_concour WHERE id_concour not in (SELECT id_concour FROM t_liste_candidat_concour WHERE id_condidat=?))");
    $req->execute([$_SESSION["user"]["id_candidat"]]);
    $liste_concour_invite = $req->fetchall();
    //liste du chaque concours pour le candidat
    $req = $pdo->prepare("SELECT * FROM t_concours WHERE id_concours in (SELECT id_concour from t_liste_candidat_concour WHERE id_condidat=?)");
    $req->execute([$_SESSION["user"]["id_candidat"]]);
    $liste_concour_condidat_invite = $req->fetchall();

?>

<h1 class="mb-5 mt-3"><span style="border-bottom: 3px solid black;">Bienvenue <?=$_SESSION["user"]["nom_candidat"];?> <?=$_SESSION["user"]["prenom_candidat"];?></span></h1>
<h2 class="text-center text-light bg-warning mb-5" style="border-radius: 5px;">Inscrire dans un concour</h3>
<div class="container row justify-content-around">
    <?php for($i=0; $i<6; $i++): ?>
    <div class="card border-dark mb-3" style="max-width: 20rem;">
        <div class="card-header text-center"><?= $concours[$i]["titre_concour"]?></div>
        <div class="card-body">
            <div class="card-title text-center">Description</div>
            <div class="card-text text-center">
            <?= $concours[$i]["concours_designation"]?>
            </div>
        </div>
        <div class="mx-auto mb-1">
            <a href=<?=$concours[$i]["lien_module"]?> class="btn btn-outline-dark ">Voir les modules</a>
        </div>
        <?php $skip=false;foreach ($liste_concour as $element_concour):?>
            <?php if($element_concour[0] == $concours[$i]["id_concours"]):?>
                <div class="mx-auto mb-1">
                    <p class="alert alert-success my-0 p-2">vous êtes inscrit</p>
                </div>
            <?php $skip=true;
                break;?>
            <?php endif?>
        <?php endforeach;?>
        <?php if(!$skip):?>
        <div class="mx-auto mb-1">
            <a href="http://localhost/stage/registerConcour.php?id=<?=$concours[$i]["id_concours"]?>" class="btn btn-outline-dark ">S'inscrire dans le concour</a>
        </div>
        <?php endif;?>
    </div>
    <?php endfor;?>
</div>
<hr class="my-4">
<h3>Préselectionement pour passé les concours</h3>
<table class="table">
    <thead class="thead-dark">
            <tr>
                <th>Nom du concour</th>
                <th>Etat</th>
            </tr>
    </thead>
    <tbody>
    <?php foreach($liste_concour_enregistre as $concour):?>
            <tr class="table-warning">
                <td><?=$concour["titre_concour"]?></td>
                <td>en attent</td>
            </tr>
        <?php endforeach; ?>
        <?php foreach($liste_concour_condidat_invite as $concour):?>
            <tr class="table-success">
                <td><?=$concour["titre_concour"]?></td>
                <td>invité</td>
            </tr>
        <?php endforeach; ?>
        <?php foreach($liste_concour_invite as $concour):?>
            <tr class="table-danger">
                <td><?=$concour["titre_concour"]?></td>
                <td>pas invité</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<hr class="my-4">
<h3>La liste final(Principal/Attente)</h3>
<table class="table">
    <thead class="thead-dark">
            <tr>
                <th>Nom du concour</th>
                <th>Etat</th>
            </tr>
    </thead>
    <tbody>
        <tr class="table-warning">
            <td>GLSID</td>
            <td>En attent</td>
        </tr>
        <tr class="table-success">
            <td>IIBDCC</td>
            <td>Liste Principale<a href="#" class="btn btn-info mx-2">voir la liste</a></td>
        </tr>
        <tr class="table-secondary">
            <td>GIL</td>
            <td>Liste d'attente<a href="#" class="btn btn-info mx-2">voir la liste</a></td>
        </tr>
        <tr class="table-danger">
            <td>GMSI</td>
            <td>Aucune liste<a href="#" class="btn btn-info mx-2">voir la liste</a></td>
        </tr>
    </tbody>
</table>