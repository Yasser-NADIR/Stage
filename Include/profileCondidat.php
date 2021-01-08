<?php 
    $concours = $pdo->query("SELECT * FROM t_concours")->fetchall();
    //les concours que le candidat est enregistré
    $req = $pdo->prepare("SELECT id_concour FROM t_liste_concour WHERE id_condidat=?");
    $req->execute([$_SESSION["user"]["id_candidat"]]);
    $liste_concour = $req->fetchall();
    //les noms des concours que le candidat s'enregistre
    $req = $pdo->prepare("SELECT * FROM t_concours WHERE id_concours in (SELECT id_concour from t_liste_concour WHERE id_condidat=:idCondidat) AND id_concours not in (SELECT id_concour from t_liste_candidat_concour)");//A tester si cette partie en commentaire importante ou à supprimer AND id_concours not in (SELECT id_concour from t_liste_candidat_concour WHERE id_condidat=:idCondidat)");
    $req->execute(["idCondidat"=>$_SESSION["user"]["id_candidat"]]);
    $liste_concour_enregistre = $req->fetchall();
    //liste des condidats qui sont invité dans tous les concours sauf le condidat en question
    $req = $pdo->prepare("SELECT * from t_concours WHERE id_concours in (SELECT id_concour FROM t_liste_candidat_concour WHERE id_condidat!=:id_candidat and id_concour not in(SELECT id_concour FROM t_liste_candidat_concour WHERE id_condidat=:id_candidat))");
    $req->execute(["id_candidat"=>$_SESSION["user"]["id_candidat"]]);
    $liste_concour_invite = $req->fetchall();
    //liste du chaque concours pour le candidat
    $req = $pdo->prepare("SELECT * FROM t_concours WHERE id_concours in (SELECT id_concour from t_liste_candidat_concour WHERE id_condidat=?)");
    $req->execute([$_SESSION["user"]["id_candidat"]]);
    $liste_concour_condidat_invite = $req->fetchall();
    //liste de concour que sont déjà fermé
    $req = $pdo->prepare("SELECT DISTINCT id_concour FROM t_liste_candidat_concour WHERE id_condidat!=?");
    $req->execute([8]);
    $liste_concour_ferme = $req->fetchAll();

    //pour les liste principale/attente
    //si le candidat n'est pas invité donc il ne peut pas être affiché dans la liste principale ni dans la liste d'attente
    //donc on commence par le recherche des concour dont lesquels ce candidat est invité mais les resultat n'est pas encore defini
    $req = $pdo->prepare("SELECT * FROM t_concours WHERE id_concours in (SELECT id_concour from t_liste_candidat_concour WHERE id_condidat=?) AND id_concours not in (SELECT id_concour FROM t_note_concour)");
    $req->execute([$_SESSION["user"]["id_candidat"]]);
    $liste_concour_pas_resultat = $req->fetchall();
    //pour l'etape suivante :
    //premierement on partisionne la liste_note par les concours
    //deuxiemenet chaque liste de note pour chaque concour on le trier par note
    //enfin on aura une liste de deux dimention
        //la premier dimension decris les concour
        //la deuxieme decris les note

    
    $liste_concour_principale = array();
    $liste_concour_attente = array();
    $aucune_liste = array();
    $id_candidat = $_SESSION["user"]["id_candidat"];
    $done = false;

    for($i=0; $i<6; $i++){
        //ici on demande le nombre du candidat pour chaque liste(principale/attente) pour chaque filiere($i+1)
        $req = $pdo->prepare("SELECT * FROM t_nbr_principale_attente WHERE id_concour = ?");
        $req->execute([$i+1]);
        $nbr_liste_principale_attente = $req->fetch();
        // si le responsable n'a pas entré les resultats donc les candidats sont ni dans la liste principale ni dans l'attente
        if($nbr_liste_principale_attente == [])
            continue;
        //ici on trie les notes par la suite on prend les nombre de liste principale du candidats si le candidat en question
        //est dans la liste principale danc la requete va retourner le nom du concour sinon une liste vide
        //et par la suite saute vers itération suivante
        $query = "SELECT id_candidat FROM t_note_concour WHERE id_concour = ? ORDER BY note LIMIT ".$nbr_liste_principale_attente["nbrListePrincipale"];
        $req = $pdo->prepare($query);
        $req->execute([$i+1]);
        $tempo = $req->fetchAll();
        if($tempo != []){
            foreach($tempo as $item){
                if($item[0]==$id_candidat){
                    $liste_concour_principale[$i] = $concours[$i]["titre_concour"];
                    $done = true;
                    break;
                }
            }
            if($done)
                continue;
        }
        //ici on trie les notes par la suite on prend les nombre de liste attente du candidats commençant par où on a arrêté par rapport la requête
        //precidente si le candidat en question est dans la liste principale danc la requete va retourner le nom du concour sinon une liste vide
        //et par la suite saute vers itération suivante
        $query = "SELECT id_candidat FROM t_note_concour WHERE id_concour = ? ORDER BY note LIMIT ".$nbr_liste_principale_attente["nbrListeAttente"]." OFFSET ".$nbr_liste_principale_attente["nbrListePrincipale"];
        $req = $pdo->prepare($query);
        $req->execute([$i+1]);
        $tempo = $req->fetchAll();
        if($tempo != []){
            foreach($tempo as $item){
                if($item[0]==$id_candidat){
                    $liste_concour_attente[$i] = $concours[$i]["titre_concour"];
                    $done = true;
                    break;
                }
            }
            if($done)
                continue;
        }
        //si le condidat n'est pas ni dans la liste principale ni dans la liste attente et il est déja passé le concour
        //donc il n'est pas accépté (Maleuresement)
        $req = $pdo->prepare("SELECT * from t_concours WHERE id_concours = ?");
        $req->execute([$i+1]);
        $aucune_liste[$i] = $req->fetch()["titre_concour"];
    }
?>
<style>
    body{
        background: rgba(18, 123, 163, 0.1234);
    }
</style>

<?php /*<h1 class="mb-5 mt-3"><span style="border-bottom: 3px solid black;">Bienvenue <?=$_SESSION["user"]["nom_candidat"];?> <?=$_SESSION["user"]["prenom_candidat"];?></span></h1>*/?>
<h1 class="mb-5 mt-3" style="text-align: center;">
    <span style="border-bottom: 3px solid black;">
        Bienvenue <?=$_SESSION["user"]["nom_candidat"];?> <?=$_SESSION["user"]["prenom_candidat"];?>
    </span>
</h1>
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
            <?php foreach($liste_concour_ferme as $element_concour):?>
                <?php if($element_concour[0]==$concours[$i]["id_concours"]):?>
                    <div class="mx-auto mb-1">
                        <p class="alert alert-danger my-0 p-2">Vous pouvez plus s'inscrire</p>
                    </div>
                    <?php $skip=true; break;?>

                <?php endif; ?>    
            <?php endforeach; ?>
        <?php if(!$skip):?>
        <div class="mx-auto mb-1">
            <a href="http://localhost/stage/registerConcour.php?id=<?=$concours[$i]["id_concours"]?>" class="btn btn-outline-dark ">S'inscrire dans le concour</a>
        </div>
        <?php endif; ?>
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
        <?php foreach($liste_concour_pas_resultat as $concour):?>
            <tr class="table-warning">
            <td><?=$concour["titre_concour"]?></td>
            <td>En attent</td>
        </tr>
        <?php endforeach; ?>
        <?php foreach($liste_concour_principale as $concour):?>
        <tr class="table-success">
            <td><?=$concour?></td>
            <td>Liste Principale</td>
        </tr>
        <?php endforeach; ?>
        <?php foreach($liste_concour_attente as $concour): ?>
        <tr class="table-secondary">
            <td><?=$concour?></td>
            <td>Liste d'attente</td>
        </tr>
        <?php endforeach; ?>
        <?php foreach($aucune_liste as $concour):?>
        <tr class="table-danger">
            <td><?=$concour?></td>
            <td>Aucune liste</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>