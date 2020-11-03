<?php 
    require_once "bd.php";
    function debug($var){
        var_dump($var);
    }
    
    function upload($name){
        $upload_dir = "Upload/";
        $upload_file = $upload_dir.basename($_FILES[$name]["name"]);
        move_uploaded_file($_FILES[$name]["tmp_name"], $upload_file);
        return $upload_file;
    }

   function getItab(){
       global $pdo;
       $resultats = $pdo->query("SELECT * FROM t_etablissement")->fetchall();
       return $resultats;
   }

   function getDiplomt(){
        global $pdo;
        $resultats = $pdo->query("SELECT * FROM t_diplomt")->fetchall();
        return $resultats;
    }