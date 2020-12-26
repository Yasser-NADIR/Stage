<?php 
    $title = "liste principale/attente";
    require_once "Include/Header.php";
    require_once "Include/bd.php";
    $id_concour = $_SESSION["user"]["id_concour"];
    $req = $pdo->prepare("SELECT id_note From t_note_concour");
    $req->execute([]);
    $resultat = $req->fetchAll();
    $display = "";
    if($resultat){
        $display = "disabled";
    }
    $req = $pdo->prepare("SELECT id_candidat FROM t_note_concour WHERE id_concour = ? ORDER BY note");
    $req->execute([$id_concour]);
    $liste_condidat_note = $req->fetchAll();

    $req = $pdo->prepare("SELECT * FROM t_nbr_principale_attente WHERE id_concour = ?");
    $req->execute([$id_concour]);
    $nbr_liste_principale_attente = $req->fetchAll();

    if($nbr_liste_principale_attente!=[]){
    $nbr_principale = intval($nbr_liste_principale_attente[0]["nbrListePrincipale"]);
    $nbr_attente = intval($nbr_liste_principale_attente[0]["nbrListeAttente"]);
    }
    $liste_principale = array();
    $liste_attente = array();
    for($i=0; $i<count($liste_condidat_note); $i++){
        if($i<$nbr_principale){
            array_push($liste_principale, $liste_condidat_note[$i][0]);
        }else if($i<$nbr_attente+$nbr_principale){
            array_push($liste_attente, $liste_condidat_note[$i][0]);
        }
    }
    if(count($liste_principale)>0){
        $in = str_repeat("?,", count($liste_principale)-1)."?";
        $req = $pdo->prepare("SELECT nom_candidat, prenom_candidat, code_massar FROM t_candidat WHERE id_candidat in ($in)");
        $req->execute($liste_principale);
        $liste_candidat_principale = $req->fetchAll();
    }else{
        $liste_candidat_principale = array();
    }

    if(count($liste_attente)>0){
        $in = str_repeat("?,", count($liste_attente)-1)."?";
        $req = $pdo->prepare("SELECT nom_candidat, prenom_candidat, code_massar FROM t_candidat WHERE id_candidat in ($in)");
        $req->execute($liste_attente);
        $liste_candidat_attente = $req->fetchAll();
    }else{
        $liste_candidat_attente = array();
    }
?>

<h2 class="m-3" style="text-align: center;">La liste principale</h2>
<table class="table">
    <thead>
        <tr>
            <th>nom prenom</th>
            <th>CNE</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($liste_candidat_principale as $item):?>
        <tr>
            <td><?=$item["nom_candidat"]." ".$item["prenom_candidat"]?></td>
            <td><?=$item["code_massar"]?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<hr>

<h2 class="m-3" style="text-align: center;">La liste d'attente</h2>
<table class="table">
    <thead>
        <tr>
            <th>nom prenom</th>
            <th>CNE</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($liste_candidat_attente as $item):?>
        <tr>
            <td><?=$item["nom_candidat"]." ".$item["prenom_candidat"]?></td>
            <td><?=$item["code_massar"]?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<hr>
<a href="http://localhost/stage/updateNote.php" class="btn btn-primary">mettre à jour les notes</a>
<a href="http://localhost/stage/insertNote.php" class="btn btn-primary <?=$display?>" >inserer les notes</a>
<a href="http://localhost/stage/profile.php" class="btn btn-primary">retourner au profile</a>
<?php require_once "Include/Footer.php";?>