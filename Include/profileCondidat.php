<h1 class="mb-5 mt-3" ><span style="border-bottom: 3px solid black;">Bienvenue <?=$_SESSION["user"]["nom_candidat"];?> <?=$_SESSION["user"]["prenom_candidat"];?></span></h1>
<?php $concours = $pdo->query("SELECT * FROM t_concours")->fetchall();
?>
<h2 class="text-center text-light bg-warning mb-5" style="border-radius: 5px;">Inscrire dans un concour</h3>
<div class="container row justify-content-around">
    <div class="card border-dark mb-3" style="max-width: 20rem;">
        <div class="card-header text-center">GLSID</div>
        <div class="card-body">
            <div class="card-title text-center">Description</div>
            <div class="card-text text-center">
                Type : Formation Initiale <br>
                Diplôme : Ingénieur d'état <br>
                Département : Mathématiques et Informatique 
            </div>
        </div>
        <div class="mx-auto mb-1">
            <a href="https://www.enset-media.ac.ma/formations/initiales/17776/modules" class="btn btn-outline-dark ">Voir les modules</a>
        </div>
        <div class="mx-auto mb-1">
            <a href="#" class="btn btn-outline-dark ">S'inscrire dans le concour</a>
        </div>
    </div>
    <div class="card border-dark mb-3" style="max-width: 20rem;">
        <div class="card-header text-center">GLSID</div>
        <div class="card-body">
            <div class="card-title text-center">Description</div>
            <div class="card-text text-center">
                Type : Formation Initiale <br>
                Diplôme : Ingénieur d'état <br>
                Département : Mathématiques et Informatique 
            </div>
        </div>
        <div class="mx-auto mb-1">
            <a href="#" class="btn btn-outline-dark ">Voir les modules</a>
        </div>
        <div class="mx-auto mb-1">
            <a href="#" class="btn btn-outline-dark ">S'inscrire dans le concour</a>
        </div>
    </div>
    <div class="card border-dark mb-3" style="max-width: 20rem;">
        <div class="card-header text-center">GLSID</div>
        <div class="card-body">
            <div class="card-title text-center">Description</div>
            <div class="card-text text-center">
                Type : Formation Initiale <br>
                Diplôme : Ingénieur d'état <br>
                Département : Mathématiques et Informatique 
            </div>
        </div>
        <div class="mx-auto mb-1">
            <a href="#" class="btn btn-outline-dark ">Voir les modules</a>
        </div>
        <div class="mx-auto mb-1">
            <a href="#" class="btn btn-outline-dark ">S'inscrire dans le concour</a>
        </div>
    </div>
</div>
<!--
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Situation</th>
            <th scope="col">Etat</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-warning">
            <td>Invocation au concour</td>
            <td>En attent</td>
        </tr>
        <tr class="table-warning">
            <td>affichage des liste</td>
            <td>En attent</td>
        </tr>
    </tbody>
</table>
<h3>Pour mettre à jour votre profile <a href="update.php" class="btn btn-primary">clicker ici!!!</a></h3>
-->