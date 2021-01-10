<?php 
    session_start();
    require_once "Include/function.php";
    verifyAdmin();
    require_once "Include/bd.php";
    $id_concour = $_SESSION["user"]["id_concour"];
    if(!empty($_POST) && !in_array("", $_POST)){
        $is_good = true;
        $nbrListePrincipale = $_POST["nbrListePrincipale"];
        $nbrListeAttente = $_POST["nbrListeAttente"];
        unset($_POST["nbrListePrincipale"]);
        unset($_POST["nbrListeAttente"]);
        
        $query = "UPDATE t_note_concour SET note=? where id_candidat=? and id_concour=?;";
        $queries = "";
        $list = array();

        foreach($_POST as $key=>$item){
            if(!is_numeric($item) || $item<0){
                $is_good = false;
                break;
            }
            $queries = $queries.$query;
            array_push($list, $item);
            array_push($list, $key);
            array_push($list, $id_concour);
        }
        if(!is_numeric($nbrListeAttente) || !is_numeric($nbrListePrincipale)){
            $is_good = false;
        }
        echo "hole";
        var_dump($is_good);
        if($is_good){
            echo "<br>";
            var_dump($queries);
            echo "<br>";
            var_dump($list);
            $req = $pdo->prepare($queries);
            $req->execute($list);
            $req = $pdo->prepare("UPDATE t_nbr_principale_attente SET nbrListePrincipale=?, nbrListeAttente=? WHERE id_concour=?");
            $req->execute([$nbrListePrincipale, $nbrListeAttente, $id_concour]);
            header("Location:principaleAttentList.php");
            exit();
        }
    }
    
    $req = $pdo->prepare("SELECT t_candidat.id_candidat,nom_candidat, prenom_candidat, code_massar, note FROM t_note_concour, t_candidat WHERE t_note_concour.id_candidat = t_candidat.id_candidat and id_concour=?");
    $req->execute([$id_concour]);
    $liste_note = $req->fetchALL();

    $req = $pdo->prepare("SELECT nbrListePrincipale, nbrListeAttente FROM t_nbr_principale_attente WHERE id_concour=?");
    $req->execute([$id_concour]);
    $nbr_principale_attente = $req->fetchALL()[0];
?>


<?php 
    $title = "MAJ des notes";
    require_once "Include/Header.php";
?>

<style>
    body{
        background: rgba(18, 123, 163, 0.1234);
    }
</style>

<h2 class="m-3" style="text-align: center;"><span style="border-bottom:3px solid black;">Mettre à jour les notes</span></h2>
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
            <?php foreach($liste_note as $item):?>
            <tr>
                <td><?=$item["nom_candidat"]." ".$item["prenom_candidat"]?></td>
                <td><?=$item["code_massar"]?></td>
                <td>
                    <input type="text" name="<?=$item["id_candidat"]?>" value="<?=$item["note"]?>" class="form-control" style="width:20%; margin:auto;">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="form-group row">
        <label for="" class="m-auto">Nombre du candidat dans liste pricipale: <input type="text" name="nbrListePrincipale" id="" value="<?=$nbr_principale_attente["nbrListePrincipale"]?>" class="form-control"></label>
        <label for="" class="m-auto">Nombre du candidat dans liste: <input type="text" name="nbrListeAttente" id="" value="<?=$nbr_principale_attente["nbrListeAttente"]?>" class="form-control"></label>
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-outline-primary mx-3">update</button>
        <a href="http://localhost/stage/principaleAttentList.php" class="btn btn-outline-primary mx-3">retourner</a>
    </div>
</form>

<?php require_once "Include/Footer.php"?>