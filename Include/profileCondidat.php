<?php 
    $concours = $pdo->query("SELECT * FROM t_concours")->fetchall();
    $req = $pdo->prepare("SELECT id_concour FROM t_liste_concour WHERE id_condidat=?");
    $req->execute([$_SESSION["user"]["id_candidat"]]);
    $liste_concour = $req->fetchall();
?>

<h1 class="mb-5 mt-3" ><span style="border-bottom: 3px solid black;">Bienvenue <?=$_SESSION["user"]["nom_candidat"];?> <?=$_SESSION["user"]["prenom_candidat"];?></span></h1>
<h2 class="text-center text-light bg-warning mb-5" style="border-radius: 5px;">Inscrire dans un concour</h3>
<div class="container row justify-content-around">
    <?php for($i=0; $i<3; $i++): ?>
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
                    <a href="#" class="btn btn-outline-success">vous êtes déjà inscrit</a>
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
<div class="container row justify-content-around">
    <?php for($i=3; $i<6; $i++): ?>
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
                    <a href="#" class="btn btn-outline-success">vous êtes déjà inscrit</a>
                </div>
            <?php $skip=true;
            break;
                    ?>
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
<!--
<h3>Pour mettre à jour votre profile <a href="update.php" class="btn btn-primary">clicker ici!!!</a></h3>
-->