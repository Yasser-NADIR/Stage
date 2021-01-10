<?php 
    session_start();
    require_once "Include/function.php";
    verifyAdmin();
?>

<style>
    h2{
        text-align: center;
    }
    h2 span{
        border-bottom: 3px solid black; 
        border-radius: 1px;
    }
    div .container-option{
        padding: 0px 200px;
    }
    div .option{
        display: flex;
        justify-content: center;
        border: 1px solid black;
        border-radius: 5px;
    }
    .choise{
        flex: 1;
        text-align: center;
    }
    .description-choise{
        font-size: 1.5em;
    }
    .barre-vertical{
        border: 1px solid black;
        margin: 0 5px;
    }
    .href-choise{
        font-size: 1.3em;
    }
</style>

<h2 class="mt-3 mb-5">
    <span>
        Bienvenue dans la page du gestion de concour
    </span>
</h2>
<div class="container container-option">
    <div class="my-3 option p-3">
        <div class="choise">
            <p class="description-choise">pour accéder a la page des candidat qui sont inscrits: </p>
                <a href="http://localhost/stage/finalList.php" class="btn btn-outline-primary my-1 href-choise">
                    liste du concour
                </a>
            
        </div>
        <div class="barre-vertical"></div>
        <div class="choise">
            <p class="description-choise"> pour entrer les note les liste principale et attente:</p>
                <a href="http://localhost/stage/principaleAttentList.php" class="btn btn-outline-primary my-1 href-choise">
                    liste principale/d'attente
                </a>
            
        </div>
    </div>
</div>