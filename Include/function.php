<?php 
    require_once "bd.php";
    require_once "PHPMailer/PHPMailerAutoload.php";
    
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

    function strRandom($length){
        $alphabet = "abcdefghijklmnopqrstuvwxyzABSDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    function send($to, $subject="", $body=""){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = "587";
        $mail->SMTPSecure = "tls";
        $mail->Username = "azertytest333@gmail.com";
        $mail->Password = "azerty@azerty";
        $mail->isHTML();
        $mail->setFrom("yassernadir761@gmail.com");
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        return $mail->Send();
    }

    function triParMoyen($candidat1, $candidat2){
        if($candidat1["m"]==$candidat2["m"]) return 0;
        if($candidat1["m"]>$candidat2["m"]) return -1;
        if($candidat1["m"]<$candidat2["m"]) return 1;
    }