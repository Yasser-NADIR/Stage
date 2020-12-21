<?php 
    $title = "liste principale";
    require_once "Include/Header.php";
?>

<h2 class="m-3" style="text-align: center;">La liste principale</h2>
<table class="table">
    <thead>
        <tr>
            <th>nom</th>
            <th>selectionner</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>NADIR Yasser</td>
            <td><input type="checkbox" name="" id=""></td>
        </tr>
    </tbody>
</table>
<hr>
<a href="http://localhost/stage/principaleAttentList.php" class="btn btn-primary">affichage du liste principale/attente</a>
<?php require_once "Include/Footer.php";?>