<?php
    session_start();
    require_once "Include/bd.php";
    $id_concour = $_SESSION["user"]["id_concour"];
    if(!empty($_POST) && !in_array("", $_POST)){
        $is_good = true;
        $nbrListePrincipale = $_POST["nbrListePrincipale"];
        $nbrListeAttente = $_POST["nbrListeAttente"];
        unset($_POST["nbrListePrincipale"]);
        unset($_POST["nbrListeAttente"]);
        $query = "INSERT INTO t_note_concour(id_candidat, note, id_concour) VALUES ";
        $list = array();
        foreach($_POST as $key=>$item){
            if(!is_numeric($item) || $item<0){
                $is_good = false;
                break;
            }
            $query = $query."(?, ?, ?),";
            array_push($list, $key);
            array_push($list, $item);
            array_push($list, $id_concour);
        }
        if(!is_numeric($nbrListeAttente) || !is_numeric($nbrListePrincipale)){
            $is_good = false;
        }
        
        if($is_good){
            $nbrListePrincipale = intval($nbrListePrincipale);
            $nbrListeAttente = intval($nbrListeAttente);
            $query = substr($query, 0, strlen($query)-1);
            $req = $pdo->prepare($query);
            $req->execute($list);
            $req = $pdo->prepare("INSERT INTO t_nbr_principale_attente(nbrListePrincipale, nbrListeAttente, id_concour) VALUES (?,?,?)");
            $req->execute([$nbrListePrincipale, $nbrListeAttente, $id_concour]);
            header("Location:principaleAttentList.php");
            exit();
        }
    }
    
    $title = "insertion des notes";
    require_once "Include/Header.php";
    
    
    $req = $pdo->prepare("SELECT id_condidat from t_liste_candidat_concour WHERE id_concour = ?");
    $req->execute([$id_concour]);
    $resultat = $req->fetchall();
    $query = "SELECT id_candidat, nom_candidat, prenom_candidat, code_massar FROM t_candidat WHERE id_candidat in (";
    foreach($resultat as $list){
        $query = $query.$list[0].",";
    }
    $query = substr($query, 0, strlen($query)-1);
    $query = $query.")";
    $resultat = $pdo->query($query)->fetchAll();
?>

<h2 class="m-3" style="text-align: center;"><span style="border-bottom:3px solid black;">Insertion des notes</span></h2>
<form action="" method="post">
    <table class="table"  style="text-align: center;">
        <thead>
            <tr>
                <th>nom prenom</th>
                <th>code massar</th>
                <th>note</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($resultat as $item):?>
            <tr>
                <td><?=$item["nom_candidat"]." ".$item["prenom_candidat"]?></td>
                <td><?=$item["code_massar"]?></td>
                <td>
                    <input type="text" name="<?=$item["id_candidat"]?>" class="form-control" style="width:20%; margin:auto;">
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="form-group row">
        <label for="" class="m-auto">Nombre du candidat dans liste pricipale: <input type="text" name="nbrListePrincipale" id="" class="form-control"></label>
        <label for="" class="m-auto">Nombre du candidat dans liste: <input type="text" name="nbrListeAttente" id="" class="form-control"></label>
    </div>
    <button type="submit" class="btn btn-primary">inserer</button>
    <a href="http://localhost/stage/principaleAttentList.php" class="btn btn-primary">retourner</a>
</form>

<?php require_once "Include/Footer.php" ?>