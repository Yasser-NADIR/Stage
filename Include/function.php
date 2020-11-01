<?php 
    function debug($var){
        var_dump($var);
    }
    
    function upload($name){
        $upload_dir = "Upload/";
        $upload_file = $upload_dir.basename($_FILES[$name]["name"]);
        move_uploaded_file($_FILES[$name]["tmp_name"], $upload_file);
        return $upload_file;
    }

   