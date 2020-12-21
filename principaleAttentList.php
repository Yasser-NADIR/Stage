<?php 
    $title = "liste principale/attente";
    require_once "Include/Header.php";
    require_once "Include/bd.php";
    $req = $pdo->prepare("SELECT id_note From t_note_concour");
    $req->execute([]);
    $resultat = $req->fetchAll();
    $display = "";
    if($resultat){
        $display = "disabled";
    }
?>

<h2 class="m-3" style="text-align: center;">La liste principale</h2>
<table class="table">
    <thead>
        <tr>
            <th>nom</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>NADIR Yasser</td>
        </tr>
    </tbody>
</table>
<hr>

<h2 class="m-3" style="text-align: center;">La liste d'attente</h2>
<table class="table">
    <thead>
        <tr>
            <th>nom</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>NADIR Zainab</td>
        </tr>
    </tbody>
</table>
<hr>
<a href="http://localhost/stage/updateNote.php" class="btn btn-primary">mettre à jour les notes</a>
<a href="http://localhost/stage/insertNote.php" class="btn btn-primary <?=$display?>" >inserer les notes</a>
<a href="http://localhost/stage/profile.php" class="btn btn-primary">retourner au profile</a>
<?php require_once "Include/Footer.php";?>