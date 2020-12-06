<?php   
    $id_concour = $_SESSION["user"]["id_concour"];
    //$req = $pdo->prepare("SELECT id_condidat FROM t_liste_concour WHERE id_concour=?");
    $req = $pdo->prepare("SELECT * FROM t_candidat WHERE id_candidat in( SELECT id_condidat FROM t_liste_concour WHERE id_concour=?)");
    $req->execute([$id_concour]);
    $liste = $req->fetchall();
    
    if(!empty($_POST)){
        $query = "INSERT INTO t_liste_candidat_concour(id_concour,id_condidat) VALUES ";
        $liste_condidat_concour = array();
        foreach($_POST as $id_candidat=>$on){
            $query = $query."(?,?),";
            array_push($liste_condidat_concour, (int)$id_concour, $id_candidat);
        }
        $query = substr($query, 0, strlen($query)-1);
        $req = $pdo->prepare($query);
        $req->execute($liste_condidat_concour);
    }
?>

<h2 class="mt-3"><span style="border-bottom: 3px solid black; border-radius: 1px;">Bienvenue dans la page du gestion de concour</span></h2>
<div class="my-3">
    <a href="#" class="btn btn-success">liste du concour</a>
    <a href="#" class="btn btn-success">liste principale/d'attente</a>
</div>
<?php /*
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
    <button type="submit" class="btn btn-success">Envoyer</button>
</form>
*/?>